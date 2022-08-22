<?php

namespace App\Http\Controllers;
use DB;
use App\coinsTopUpModel;
use App\Events\CoinEvent;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\notification;
use Carbon\Carbon;

class CoinsTopUpAdminController extends Controller
{
    function index(){
        $users = coinsTopUpModel::all();
        // $users = DB::table('coins_top_up')->get();
        if (Auth::user()->role->name == 'admin') {
            // code...
             return view('admin.coins_top_up.index')->with('users', $users)->with('panel_name', 'coins_top_up');
        }else if (Auth::user()->role->name == 'CoinsTopUpEmployee') {
            // code...
            return view('coinsTopUpEmpPanel.coins_top_up.index')->with('users', $users)->with('panel_name', 'coins_top_up');
        }
    }

    function more_info($trans_id){
        $userobj = DB::table('coins_top_up')->where('id', $trans_id)->first();
        return view('admin.coins_top_up.more_info')->with('user', $userobj)->with('panel_name', 'coins_top_up');
    }

    function set_verified($trans_id){
        $coinsTopUp = coinsTopUpModel::where('id', $trans_id)->first();
        $coinsTopUp->remarks = '1';
        $coinsTopUp->invalid_reason = '';
        $coinsTopUp->approved_by_user_id = Auth::user()->id;
        $coinsTopUp->save();

           // notification entity for orders
            $notification_ent = new notification();
            $notification_ent->user_id = $coinsTopUp->user_id;
            $notification_ent->frm_user_id = '2';
            $notification_ent->notification_title = 'Coins top up for ' . $coinsTopUp->reference_id;
            $status_messages = '<br>Coins top up for <br>' . $coinsTopUp->reference_id . '<br>is completed';
            $notification_ent->notification_txt = $status_messages;
            $notification_ent->save();

            $emailData = [
                'id' => $notification_ent->user_id,
                'subject' => $notification_ent->notification_title,
                'details' => $notification_ent->notification_txt
            ];
            $this->sendEmailNotif( $emailData );

            $emailData = [
                'id' => $coinsTopUp->user_id,
                'subject' => $notification_ent->notification_title,
                'details' => $status_messages
            ];
            $this->sendEmailNotif( $emailData );
        // DB::table('coins_top_up')->where('id', $trans_id)->update(['remarks' => 1]);
        return back();
    }

    function unset_verified($trans_id){
        $coinsTopUp = coinsTopUpModel::where('id', $trans_id)->first();
        $coinsTopUp->remarks = '0';
        $coinsTopUp->invalid_reason = '';
        $coinsTopUp->approved_by_user_id = Auth::user()->id;
        $coinsTopUp->save();

           // notification entity for orders
            $notification_ent = new notification();
            $notification_ent->user_id = $coinsTopUp->user_id;
            $notification_ent->frm_user_id = '2';
            $notification_ent->notification_title = 'Coins top up for ' . $coinsTopUp->reference_id;
            $status_messages = '<br>Coins top up for <br>' . $coinsTopUp->reference_id . '<br>is declined';
            $notification_ent->notification_txt = $status_messages;
            $notification_ent->save();
            
            $emailData = [
                'id' => $coinsTopUp->user_id,
                'subject' => $notification_ent->notification_title,
                'details' => $status_messages
            ];
            $this->sendEmailNotif( $emailData );
            return back();
    }

    function edit_coins_top_up_submit(Request $req){
        $coinsTop_UpImage = $req->file('new_coins_top_up_image');
        if($coinsTop_UpImage != null){
            $coinsTop_UpImageSaveAsName = time() . uniqid() . "-coinsTopUp." . $coinsTop_UpImage->getClientOriginalExtension();
            $upload_path = 'storage/coinsTopUp/' . date('FY') . '/';
            $upload_path_url = 'coinsTopUp\\' . date('FY') . '\\';
            $coinsTop_Up_image_url = $upload_path_url . $coinsTop_UpImageSaveAsName;
            $success = $coinsTop_UpImage->move($upload_path, $coinsTop_UpImageSaveAsName);
            DB::table('coins_top_up')->where('id', $req->user_id)
            ->update([
                'image_proof' => $coinsTop_Up_image_url,
                'remarks' => 1,
                'value' => $req->new_amount,
                'trans_id' => $req->new_transaction_id
            ]);
        }else{
            DB::table('coins_top_up')->where('id', $req->user_id)
            ->update([
                'remarks' => 1,
                'value' => $req->new_amount

            ]);
        }

        event( new CoinEvent( [ 'user_id' => $req->_userid, 'type' => 'update-top-up' ] ) );
        $currentTime = Carbon::parse( time() )->format( 'M d, Y h:i:s' );
        $notifData = [
            'user_id' => $req->_userid,
            'frm_user_id' => $this->userId(),
            'notification_title' => "Coin top up approved",
            'notification_txt' => "Your coin top up has been approved. <br><br> Reference ID: {$req->ref_id} <br> Date approved: {$currentTime}",
        ];
        $this->newNotificationWithEvent( $notifData );
        return back();
    }

    function submit_edit_amount(Request $req){
        // new_amount
        // trans_id
        DB::table('coins_top_up')->where('id', $req->trans_id)
        ->update([
            'value' => $req->new_amount
        ]);

        return back();
    }

    function delete_coins_top_up($trans_id){
        DB::table('coins_top_up')->where('id', $trans_id)->delete();
        return redirect( '/coins_dashboard' );
    }
}
