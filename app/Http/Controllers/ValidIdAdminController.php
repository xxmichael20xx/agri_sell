<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\UserValidId;
use App\TransHistModel;
use Auth;
use App\notification;
use App\adminNotifModel;
use App\Events\ShopEvent;

class ValidIdAdminController extends Controller
{
    function index(){
//        $users = DB::table('user_valid_ids')->join('users', 'user_valid_ids.user_email', '=', 'users.email')->get();
        $users = UserValidId::all();
        return view('admin.valid_ids.index')->with('users', $users)->with('panel_name', 'Users Validation');
    }

    function validIdView($validId_id){
        $user_get_email = DB::table('users')->where('id', $validId_id)->pluck('email')->first();
        $valid_id_user = UserValidId::find($validId_id);
        return view('admin.valid_ids.valid_ids_view')->with(compact('valid_id_user', 'user_get_email'))->with('panel_name', 'Users Validation');
    }
    function setValidId( $validId_id ) {
        $user_valid_id = UserValidId::find($validId_id);
        $user_valid_id->is_valid = '1';
        
        /* $trans = new TransHistModel();
        $trans->user_id_master = $user_valid_id->user_id;
        $trans->user_id_slave = $user_valid_id->user_id;
        $trans->remarks = 'Admin set as valid ID';
        $trans->trans_type = 'Valid IDs';
        $trans->trans_ref_id = 'VALID_IDs-' . uniqid();
        $trans->amount = 'not applicable';
        $trans->save(); */

        // set a notification table
        $notification_ent = new notification();
        $notification_ent->user_id = $user_valid_id->owner->id ?? 0;
        $notification_ent->frm_user_id = Auth::user()->id;
        $notification_ent->notification_title = 'Valid ID Update';
        $notification_ent->notification_txt = 'Your ID has been confirmed. You may now able to fully use the platform.';
        $notification_ent->save();
        $user_valid_id->save();

        // $adminnotif_ent = new adminNotifModel();
        // $adminnotif_ent->action_type = 'Product addition';
        // $adminnotif_ent->user_id = Auth::user()->id;
        // $adminnotif_ent->action_description = 'Added ' . $product->name . ' to the products list';
        // $adminnotif_ent->save();  

        return back();
    }

    function unsetValidId( Request $request, $validId_id ) {
        $reason = $request->invalid_id_reason;
        $isOthers = false;

        if ( $reason == 'Others' ) {
            $isOthers = true;
            $reason .= ": {$request->invalid_id_reason_others}";
        }

        $user_valid_id = UserValidId::find($validId_id);
        $user_valid_id->is_valid = '0';
        $user_valid_id->invalid_reason_id = $request->invalid_id_reason;
        $user_valid_id->save();

        /* $trans = new TransHistModel();
        $trans->user_id_master = $user_valid_id->user_id;
        $trans->user_id_slave = $user_valid_id->user_id;
        $trans->remarks = 'Admin set as invalid ID';
        $trans->trans_type = 'Valid IDs';
        $trans->trans_ref_id = 'VALID_IDs-' . uniqid();
        $trans->amount = 'not applicable';
        $trans->save(); */

        if ( ! $isOthers ) {
            $reason = DB::table('invalid_id_reasons')->where('id', $request->invalid_id_reason)->first();
            $reason = $reason->description;
        }

        $notification_txt = "
            {$reason}
            <br>
            <a href='/valid-id/{$user_valid_id->id}' class='text-success font-weight-bold'>Click here to re-upload ID.</a>
        ";

        // set a notification table
        $notification_ent = new notification();
        $notification_ent->user_id = $user_valid_id->owner->id ?? 'not available';
        $notification_ent->frm_user_id = Auth::user()->id;
        $notification_ent->notification_title =  'Your ID is `' . $reason . '`';
        $notification_ent->notification_txt = $notification_txt;
        $notification_ent->save();

        event( new ShopEvent( [ 'customer_id' => $user_valid_id->user_id, 'type' => 'order-event' ] ) );
     
        return back();
    }

    function editValidId($validId_id){
        $user_get_email = DB::table('users')->where('id', $validId_id)->pluck('email')->first();
        $valid_id_user = DB::table('user_valid_ids')->where('user_email', $user_get_email)->first();
        $user = DB::table('users')->where('id', $validId_id)->first();
        return view('admin.valid_ids.edit_valid_id')->with(compact('valid_id_user', 'user'))->with('panel_name', 'Users Validation');
    }


    function deleteValidId($validId_id){
        $user_valid_id = UserValidId::find($validId_id);
        $user_valid_id->delete();
        // $user_get_email = DB::table('users')->where('id', $validId_id)->pluck('email')->first();
        // $valid_id_user = DB::table('user_valid_ids')->where('user_email', $user_get_email)->delete();
        return back();
    }

    function validIdEditSubmit(Request $req){
        $valid_idImage = $req->file('new_valid_id');
        if($valid_idImage == null){
            return back();
        }
        // $user_email = DB::table('users')->where('id', $req->user_id)->pluck('email')->first();
        
        $valid_idImageSaveAsName = time() . uniqid() . "-valid_id." . $valid_idImage->getClientOriginalExtension();

        $upload_path = 'storage/user-valid-ids/' . date('FY') . '/';
        $upload_path_url = 'user-valid-ids\\' . date('FY') . '\\';
        $valid_id_image_url = $upload_path_url . $valid_idImageSaveAsName;
        $user_valid_id = UserValidId::find($req->user_id);
        $user_valid_id->valid_id_path = $valid_id_image_url;
        $user_valid_id->save();
        
        $success = $valid_idImage->move($upload_path, $valid_idImageSaveAsName);
        return back();
    }

}
