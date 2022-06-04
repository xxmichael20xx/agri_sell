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
            'rider_vehicle' => 'required'
        ] );

        $user = new User();
        $user->role_id = '5';
        $user->name = $request->rider_name;
        $user->email = $request->rider_email;
        $user->password = bcrypt( $request->rider_password );
        $user->mobile = $request->rider_contact;
        $user->email_verified_at = NOW();
        $user->address = 'not defined';
        $user->barangay = 'Amamperez';
        $user->town = 'Villasis';
        $user->province = 'Pangasinan';
        $user->bday = '2021-11-10';
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
        $rider = deliveryStaffModel::where( 'user_id', $request->id )->first();

        if ( ! $rider ) {
            return back()->with( 'info', "Rider data can't be found." );
        }

        $rider->vehicle_used = $request->rider_vehicle;
        $rider->save();

        $rider_user = User::find( $request->id );
        $rider_user->name = $request->rider_name;
        $rider_user->mobile = $request->rider_contact;
        $rider_user->save();

        return back()->with( 'success', "Rider information has been updated." );
    }
}
