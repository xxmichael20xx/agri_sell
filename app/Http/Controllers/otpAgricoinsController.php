<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Seshac\Otp\Otp;
use App\Mail\sendOTPMailAgriCoins;
use Auth;
use App\User;
use App\SubOrders;
use App\Order;
use App\coinsTransaction;
use Illuminate\Support\Facades\Mail;
use App\notification;
use DB;
class otpAgricoinsController extends Controller
{
    function index($order_num){
        // otp to email
        $identifier = $order_num; 
        $otp = Otp::generate($identifier);
        $user = User::where('id', Auth::user()->id);
        $recepient_email = Auth::user()->email;
        $recepient_name = Auth::user()->name;

        // $order_ent_tmp = Order::where('order_num', $order_num)->first();
        $order_obj = Order::where('order_number', $order_num)->first();
        // 'order_object' => $sub_order,
        
        $price = $order_obj->grand_total;

        $data = array(
            'user_object_recepient' => $user,
            'order_num'  =>  $order_num,
            'otp' =>  $otp,
            'recepient_name' => $recepient_name,
            'recepient_email' => $recepient_email,
            'total_price' => $price,
            'order_obj' => $order_obj,
        );

        Mail::to($recepient_email)->send(new sendOTPMailAgriCoins($data));
        return redirect('/otp_validation_view/'. $order_num);
        // return view('otp_ag_coins.order_conf_agcoins_otp')->with('otp', $otp);
    }

    function otpAgriCoinsConfirmView($order_num){
        return view('otp_ag_coins.order_conf_agcoins_otp')->with('order_num', $order_num);
    }

    // otp confirm
    function otpAgriCoinsConfirm(Request $request){
        $otp_inputted = $request->inputted_otp;
        $order_num_requested = $request->order_num;
        
        // $verify = Otp::validate($order_num_requested, $otp_inputted);
        // $otp_verification;
        // dd($verify);
        $verify_otp = DB::table('otps')->where('token', $otp_inputted)->where('identifier', $order_num_requested)->first();

        if ( $verify_otp ) {
            // on hold
            // perform some suborder tables
            // plan to deduct the agricoins
            // perform coins transaction
            $order_obj = Order::where('order_number', $request->order_num)->first();
         
            $coins_trans = new coinsTransaction();
            $order_obj->is_paid = '1';
            $coins_trans->user_id = Auth::user()->id;
            $coins_trans->value = $order_obj->grand_total;
            $coins_trans->order_reference_number = $order_obj->order_number;
            $coins_trans->time_conducted = date('Y-m-d H:i:s');
            $coins_trans->transaction_type = 'Item orders';
            $coins_trans->save();

            // notification entity
            $notification_ent = new notification();
            $notification_ent->user_id = $sell_reg_inst->owner->id ?? 'not available';
            $notification_ent->frm_user_id = Auth::user()->id;
            $notification_ent->notification_title = 'OTP agricoins verification';
            $notification_ent->notification_txt = 'You spend: ' . $coins_trans->value = $order_obj->grand_total . 'in your agricoins wallet';                ;
            $notification_ent->save();
            // end of notification entity

            $otp_verification = 'true';
            $order_obj->agrisell_coins_payment_status = 'approved';
            $order_obj->save();

        } else {
            // perform some suborder unverifed columns
            // plan to not deduct the agricoins
            // do not perform coins transaction  
            $order_obj = Order::where('order_number', $request->order_num)->first();
            $order_obj->agrisell_coins_payment_status = 'denied';

            $notification_ent = new notification();
            $notification_ent->user_id = $sell_reg_inst->owner->id ?? 'not available';
            $notification_ent->user_id = Auth::user()->id;
            $notification_ent->frm_user_id = Auth::user()->id;
            $notification_ent->notification_title = 'OTP agricoins verification for ' . $order_obj->order_number;
            $notification_ent->notification_txt = "Agri coins payment denied <br> OTP Code is invalid/incorrect.<br>Click <a href='/otp_validation_view/{$order_num_requested}' style='color: #28A745;'>here</a>";
            $notification_ent->save();
            // end of notification entity

            $order_obj->save();
            $otp_verification = 'false';
        }
        // else{
        //     $order_obj = Order::where('order_number', $request->order_num)->first();

        //     $coins_trans = new coinsTransaction();
        //     $order_obj->is_paid = '1';
        //     $coins_trans->user_id = Auth::user()->id;
        //     $coins_trans->value = $order_obj->grand_total;
        //     $coins_trans->order_reference_number = $order_obj->order_number;
        //     $coins_trans->time_conducted = date('Y-m-d H:i:s');
        //     $coins_trans->transaction_type = 'Item orders';
        //     $coins_trans->save();

        //     $otp_verification = 'true';
        //     $order_obj->agrisell_coins_payment_status = 'approved';
        //     $order_obj->save();
        // }
        // view otp routes coins
        return view('otp_ag_coins.order_conf_agcoins_otp_status')->with('otp_verification', $otp_verification)->with('otp_order_num', $order_num_requested)->with('order_obj', $order_obj);
    }


    // otp coins confirm via button
    function confirmViaButton($otp_token, $order_num){
        // perform some functions
        $verify = Otp::validate($order_num, $otp_token);

        if($verify->status == 'true'){
            // perform some verified suborder tables
            $otp_verification = 'true';
            $order_obj = Order::where('order_number', $order_num)->first();
            $order_obj->agrisell_coins_payment_status = 'approved';
                        
            // notification entity
            $notification_ent = new notification();
            $notification_ent->user_id =  Auth::user()->id;
            $notification_ent->frm_user_id = '1';
            $notification_ent->notification_title = 'Otp agricoins status';
            $notification_ent->notification_txt = 'Your OTP verification for this order: ' . $order->order_number . '<br>You have paid ' . $order->grand_total;
            $notification_ent->save();

            $emailData = [
                'id' => $notification_ent->user_id,
                'subject' => $notification_ent->notification_title,
                'details' => $notification_ent->notification_txt
            ];
            $this->sendEmailNotif( $emailData );
            
            // end of notification entity
            $order_obj->save();
        }else{
            // perform some unverfied suborder tables
            $order_obj = Order::where('order_number', $order_num)->first();
            $order_obj->agrisell_coins_payment_status = 'denied';

            // notification entity
            $notification_ent = new notification();
            $notification_ent->user_id =  Auth::user()->id;
            $notification_ent->frm_user_id = '1';
            $notification_ent->notification_title = 'Otp agricoins status';
            $notification_ent->notification_txt = 'Otp agricoins failed please try again for your order' . $order_num;
            $notification_ent->save();
            // end of notification entity

            $emailData = [
                'id' => $notification_ent->user_id,
                'subject' => $notification_ent->notification_title,
                'details' => $notification_ent->notification_txt
            ];
            $this->sendEmailNotif( $emailData );

            $order_obj->save();
            $otp_verification = 'false';
        }

           // view otp routes coins
           return view('otp_ag_coins.order_conf_agcoins_otp_status')->with('otp_verification', $otp_verification)->with('order_obj', $order_obj);
    }

    // function validate($order_num, $otp_pin){
    //     $identifier = $order_num;
    //     $verify = Otp::validate($identifier, $otp_pin);
    //     return view('otp_ag_coins.order_conf_agcoins_otp_status')->with('verify', $verify);
    // }

}
