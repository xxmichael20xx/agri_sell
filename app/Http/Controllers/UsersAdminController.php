<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\coinsTopUpModel;
use DB;
class UsersAdminController extends Controller
{
    function index(){
        $users = User::all();
        return view('admin.users.index')->with('users', $users)->with('panel_name', 'users');
    }

    function more_info($user_id){
        $user = User::where('id', $user_id)->first();
        $coins_total = coinsTopUpModel::where([['user_id', $user_id], ['remarks', '1']])->sum('value');
        $order_qty = DB::table('orders')->where('user_id', $user_id)->count();
        $order_obj = DB::table('orders')->where('user_id', $user_id)->get();
        $ordered_products_qty = 0;
        foreach($order_obj as $order_instance){
            $ordered_products_qty += intval(DB::table('order_items')->where('order_id', $order_instance->id)->count());
        }
        return view('admin.users.more_info')->with('user', $user)->with('panel_name', 'users')->with(compact('coins_total', 'order_qty', 'ordered_products_qty'));
    }

    function edit_user_panel($user_id){
        $roles = DB::table('roles')->get();
        $user = User::where('id', $user_id)->first();
        return view('admin.users.edit_user')->with('user', $user)->with('panel_name', 'users')->with('roles', $roles);
    }
    function edit_user_submit(Request $req){
        $user = User::where('id', $req->user_id)->first();
        $user->name = $req->full_name;
        $user->mobile = $req->mobile;
        if(isset($req->bday)){
            $user->bday = bcrypt($req->bday);
        }
        if(isset($req->password)){
            $user->password = bcrypt($req->password);
        }
        $user->bday = $req->bday;
        $user->address = $req->address_line;
        if(isset($req->province)){
            $user->province = $req->province;
        }
        if(isset($req->town)){
            $user->town = $req->town;
        }
        if(isset($req->barangay)){
            $user->barangay = $req->barangay;
        }
        if(isset($req->role_id)){
            $user->role_id = $req->role_id;
        }
        $user->save();
        return back();
    }

    function delete_user($user_id){
        DB::table('users')->where('id', $user_id)->delete();
        DB::table('seller_registration_fee')->where('user_id', $user_id)->delete();
        DB::table('shops')->where('user_id', $user_id)->delete();
        DB::table('coins_top_up')->where('user_id', $user_id)->delete();
        DB::table('refund_request_products')->where('user_id', $user_id)->delete();
       return back();
    }



}
