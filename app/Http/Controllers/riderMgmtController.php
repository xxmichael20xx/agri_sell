<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\deliveryStaffModel;
use App\User;
use DB;
class riderMgmtController extends Controller
{
    function index(){
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

    function add_new(Request $request){
        $tbl_user = DB::table('users')->where('email', $request->email)->first();
        if ($tbl_user == NULL) {
        $user = new User();
        $user->role_id = '5';
        $user->name = $request->rider_name;
        $user->email = $request->rider_email;
        $user->password = bcrypt($request->rider_password);
        $user->mobile = $request->rider_contact;
        $user->email_verified_at = '2022-02-19 19:40:43';
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

        return redirect('/admin/rider_management');
        }else{
            return back()->withMessage('Email exists');
        }
      

    }
}
