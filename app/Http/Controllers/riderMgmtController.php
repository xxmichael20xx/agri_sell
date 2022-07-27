<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\deliveryStaffModel;
use App\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class riderMgmtController extends Controller
{
    function index() {
        Cookie::queue( 'auth_user_id', Auth::id(), 3600 );
        $deliver_Staffs = deliveryStaffModel::get();
        return view('admin.deliveryStaff.index')->with(compact('deliver_Staffs'))->with('panel_name', 'rider_mgmt');
    }

    function add_new_form(){
        return view('admin.deliveryStaff.register_rider')->with('panel_name', 'rider_mgmt');
    }

    function remove_rider($user_id){
        $user = User::where('id', $user_id)->delete();
        $deliveryStaffModel = deliveryStaffModel::where('user_id', $user_id)->delete();
        return back();
    }

    function add_new( Request $request ) {
        $this->validate( $request, [
            'rider_name' => 'required',
            'rider_email' => 'required|email|unique:users,email',
            'rider_password' => 'required',
            'rider_contact' => 'required',
            'rider_vehicle' => 'required',
            'rider_address' => 'required',
            'rider_bday' => 'required',
            'rider_barangay' => 'required',
            'rider_town' => 'required',
            'rider_province' => 'required',
        ] );

        $location_path = public_path() . '/province_municipality_barangay.json';
        $location = json_decode( file_get_contents( $location_path ), true);

        $province = "Pangasinan";
        $town = "";
        $barangay = "";

        foreach ( $location as $_location ) {
            if ( $_location['id'] == $request->rider_town && ! $town ) $town = $_location['name'];
            if ( $_location['id'] == $request->rider_barangay && ! $barangay ) $barangay = $_location['name'];
        }

        $user = new User();
        $user->role_id = '5';
        $user->name = $request->rider_name;
        $user->email = $request->rider_email;
        $user->password = bcrypt( $request->rider_password );
        $user->mobile = $request->rider_contact;
        $user->email_verified_at = NOW();
        $user->address = $request->rider_address;
        $user->barangay = trim( $barangay );
        $user->town = trim( $town );
        $user->province = trim( $province );
        $user->bday = $request->rider_bday;
        $user->is_accepted_user_tos = 'yes';
        $user->save();

        $deliveryStaffModel = new deliveryStaffModel();
        $deliveryStaffModel->user_id = $user->id;
        $deliveryStaffModel->rider_id = 'AGRIDER'. uniqid();
        $deliveryStaffModel->password = $request->rider_password;
        $deliveryStaffModel->vehicle_used = $request->rider_vehicle;
        $deliveryStaffModel->save();

        return redirect( '/admin/rider_management' );
    }

    public function riderVerify( Request $request ) {
        $data = NULL;
        $decrypted = Crypt::decrypt( Cookie::get( 'auth_user_id' ), false );
        $auth_user_id = explode( '|', $decrypted )[1];
        if ( ! $auth_user_id ) return response()->json( false );

        $user = User::find( $auth_user_id );
        $match = Hash::check( $request->password , $user->password );
        $rider = deliveryStaffModel::find( $request->id );
        if ( $match ) $data = $rider->password;

        return response()->json( [ 
            'success' => $match,
            'data' => $data
        ] );
    }

    public function edit( Request $request, $id ) {
        if ( ! $id ) return redirect( '/admin/rider_management' );

        $rider = deliveryStaffModel::find( $id );
        $panel_name = "Update Rider";

        return view( 'admin.deliveryStaff.edit', compact( 'rider', 'panel_name' ) );
    }

    public function update_rider( Request $request ) {
        if ( ! $request->rider_province ) $request->merge( [ 'rider_province' => 1 ] );
        $this->validate( $request, [
            'rider_name' => 'required',
            'rider_contact' => 'required',
            'rider_vehicle' => 'required',
            'rider_address' => 'required',
            'rider_bday' => 'required',
            'rider_barangay' => 'required',
            'rider_town' => 'required',
            'rider_province' => 'required',
        ] );

        $location_path = public_path() . '/province_municipality_barangay.json';
        $location = json_decode( file_get_contents( $location_path ), true);

        $province = "Pangasinan";
        $town = "";
        $barangay = "";

        foreach ( $location as $_location ) {
            if ( $_location['id'] == $request->rider_town && ! $town ) $town = $_location['name'];
            if ( $_location['id'] == $request->rider_barangay && ! $barangay ) $barangay = $_location['name'];
        }

        $rider = deliveryStaffModel::where( 'user_id', $request->id )->first();

        if ( ! $rider ) {
            return back()->with( 'info', "Rider data can't be found." );
        }

        $rider->vehicle_used = $request->rider_vehicle;
        $rider->save();

        $rider_user = User::find( $request->id );
        $rider_user->name = $request->rider_name;
        $rider_user->mobile = $request->rider_contact;
        $rider_user->address = $request->rider_address;
        $rider_user->barangay = trim( $barangay );
        $rider_user->town = trim( $town );
        $rider_user->province = trim( $province );
        $rider_user->bday = $request->rider_bday;
        $rider_user->save();

        return back()->with( 'success', "Rider information has been updated." );
    }
}
