<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\coinsTopUpModel;
use App\Events\CoinEvent;
use Auth;
use App\TransHistModel;
use App\TransactionCode;
use App\notification;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class coinsTopUp extends Controller
{
    function submitTopUp(Request $request){
        $is_trans_code_existed = TransactionCode::trans_code_duplicate_check_display($request->transaction_id);

        if ( $is_trans_code_existed == 'no' ) {
            $proofCoinsTopUpPaymentImage = $request->file('proofTopUpPayment');
            if($proofCoinsTopUpPaymentImage == NULL || $proofCoinsTopUpPaymentImage == ''){
                return redirect('user_coins_top_up')->withMessage('Please insert image proof of top up payment  ');     
            }
            $proofImageSaveAsName = time() . uniqid() . "-coinsTopUp." . $proofCoinsTopUpPaymentImage->getClientOriginalExtension();
            $upload_path = 'storage/coinsTopUp/' . date('FY') . '/';
    
            $proof_image_url = 'coinsTopUp\\' . date('FY') . '\\' . $proofImageSaveAsName;
            $success = $proofCoinsTopUpPaymentImage->move($upload_path, $proofImageSaveAsName);
    
            // $seller_reg_fee = seller_reg_fee::where('user_id', Auth::user()->id)->first();
            $coinsTopUpModel = new coinsTopUpModel();
            $coinsTopUpModel->image_proof = $proof_image_url;
            $coinsTopUpModel->user_id = Auth::user()->id;
            $coinsTopUpModel->trans_id = $request->transaction_id;
            $coinsTopUpModel->value = $request->coins_top_up_amount;
            $coinsTopUpModel->reference_id = 'COINS' . uniqid();
            $coinsTopUpModel->coins_trans_type = $request->coins_top_up_type;
            $coinsTopUpModel->remarks = '2';
            $coinsTopUpModel->save();
    
            $trans = new TransHistModel();
            $trans->user_id_master =  Auth::user()->id;
            $trans->user_id_slave = '1';
            $trans->remarks = 'User commited coins topped up';
            $trans->trans_type = 'Coins top up';
            $trans->trans_ref_id = $request->transaction_id;
            $trans->amount = $request->coins_top_up_amount;
            $trans->save();

            // notification entity for orders
            $notification_ent = new notification();
            $notification_ent->user_id = auth()->user()->id;
            $notification_ent->frm_user_id = '2';
            $notification_ent->notification_title = 'Coins top up for ' . $coinsTopUpModel->reference_id;
            $status_messages = '<br>Your coins top up for the value ' .$request->coins_top_up_amount .'<br>PLEASE WAIT FOR THE CONFIRMATION WITHIN 24 HOURS.</br>';
            $notification_ent->notification_txt = $status_messages;
            $notification_ent->save();

            $emailData = [
                'id' => auth()->user()->id,
                'subject' => $notification_ent->notification_title,
                'details' => $status_messages
            ];
            $this->sendEmailNotif( $emailData );

            $coinUser = User::where( 'email', 'coins@agrisell.com' )->first();
            $currentTime = Carbon::parse( time() )->format( 'M d, Y h:i:s' );
            $status_messages = "Date created: {$currentTime}";

            if ( $coinUser ) {
                $notification_ent = new notification();
                $notification_ent->user_id = $coinUser->id;
                $notification_ent->frm_user_id = Auth::user()->id;
                $notification_ent->notification_title = 'New Coins top up for ' . $coinsTopUpModel->reference_id;
                $notification_ent->notification_txt = $status_messages;
                $notification_ent->save();

                event( new CoinEvent( [ 'user_id' => $coinUser->id, 'type' => 'new-top-up' ] ) );
            }

            return redirect('user_home')->withMessage('PLEASE WAIT FOR THE CONFIRMATION WITHIN 24 HOURS.');

        } else {
            return back()->withMessage( 'REFERENCE NUMBER IS ALREADY TAKEN/INVALID.' );
        }

    }

    function invalidCoinsTopUp(Request $request){
        $coinsTopUpModel = coinsTopUpModel::find($request->coins_top_uid);
        $coinsTopUpModel->invalid_reason = $request->coins_top_up_invalid;
        $coinsTopUpModel->remarks = '0';
        $coinsTopUpModel->approved_by_user_id = '';
        $coinsTopUpModel->save();

        // notification entity for orders
        $notification_ent = new notification();
        $notification_ent->user_id = $coinsTopUpModel->user_id;
        $notification_ent->frm_user_id = '2';
        $notification_ent->notification_title = 'Coins top up for ' . $coinsTopUpModel->reference_id;
        $status_messages = '<br>Coins top up request has been declined. <br>Reason: ' . ucwords( $request->coins_top_up_invalid );

        if ( $request->coins_top_up_invalid == 'not valid' ) {
            $status_messages .= '<br><a href="/user_coins_top_up" style="color: #28A745;">Try Again</a>';
        }

        $notification_ent->notification_txt = $status_messages;
        $notification_ent->save();

        $emailData = [
            'id' => $coinsTopUpModel->user_id,
            'subject' => $notification_ent->notification_title,
            'details' => $status_messages
        ];
        $this->sendEmailNotif( $emailData, 'others' );

        event( new CoinEvent( [ 'user_id' => $coinsTopUpModel->user_id, 'type' => 'update-top-up' ] ) );
        
        return back();
    }
}
