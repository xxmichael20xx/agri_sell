<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\refundModelOrder;
use App\Order;
use App\OrderItem;
use App\notification;
use App\coinsTopUpEmployeeEntry;
use Auth;
use App\Product;
use DB;
use App\coinsTopUpModel;
use App\Events\CoinEvent;
use App\Events\ShopEvent;
use App\prod_refund_statuses;
use App\User;
use Carbon\Carbon;

class refundController extends Controller
{   
    public function refund_request_order($order_id, $order_item_id){
        // $refund = new refundModelOrder();
        $order_ent = Order::where('id', $order_id)->first();
        $order_item_ent = OrderItem::where('id', $order_item_id)->first();
        $choices = prod_refund_statuses::all();

        return view('orderProductRefund.refund')->with(compact('order_ent', 'order_item_ent', 'choices'));
    }

    public function refund_index(){
        $refund_requests = refundModelOrder::where('user_id', Auth::user()->id)->latest()->get();
        return view('orderProductRefund.user_refund_requests')->with(compact('refund_requests'));
    }

    public function admin_refund_mgmt_index(){
        $refund_reqs = refundModelOrder::latest()->get();
        return view('orderProductRefund.admin_refund_mgmt')->with('panel_name', 'refund_management')->with(compact('refund_reqs'));
    }

    public function admin_refund_mgmt_view($refund_req_id){
        $refund_request = refundModelOrder::where('id', $refund_req_id)->first();
         return view('orderProductRefund.admin_refund_mgmt_more_info')->with('panel_name', 'refund_management')->with(compact('refund_request'));

    }
    public function refund_request_order_confirm( Request $req ) {
        $refund_request = new refundModelOrder();
        $multiple_images = $req->file('images');
        $multiple_images_path = '';
        $multiple_images_counter = 1;

        if ( $req->hasFile( 'images' ) ) {
            foreach ( $multiple_images as $single_image ) {
                $productImage = $single_image;
                $productImageSaveAsName = time() . uniqid() . "-product." . $productImage->getClientOriginalExtension();
                $upload_path = 'storage/product_refunds/' . date('FY') . '/';
                $upload_path_url = 'product_refunds//' . date('FY') . '//';
                $product_image_url = $upload_path_url . $productImageSaveAsName;
                $success = $productImage->move($upload_path, $productImageSaveAsName);
                $multiple_images_path .= $product_image_url . ',';
                $multiple_images_counter++;
            }
        }

        if ( $req->reason_prod_txt == "others" ) {
            $reason = "Others: " . $req->other_reason_prod_txt ?? '';

        } else {
            $status = prod_refund_statuses::find( $req->reason_prod_txt );
            $reason = $status->slug;

        }

        $refund_request->image_proofs = $multiple_images_path;
        $refund_request->refund_ref_id = 'REFUND-' . uniqid();
        $refund_request->order_item_id = $req->order_item_id;
        $refund_request->user_id = Auth::user()->id;
        $refund_request->order_id = $req->order_id;
        $refund_request->product_id = $req->product_id;
        $refund_request->order_item_id = $req->order_item_id;
        $refund_request->refund_reason_prod_txt = $reason;
        $refund_request->save();

        // notification entity
        $notification_ent = new notification();
        $notification_ent->user_id = Auth::user()->id;
        $notification_ent->frm_user_id = Auth::user()->id;
        $notification_ent->notification_title = 'Refund request for ' . Order::where('id', $req->order_item_id)->first()->order_number;
        $notification_ent->notification_txt = 'Your refund process for : ' . Product::where('id', $req->product_id)->first()->name . ' is on progress<br>You can check your refund request in the <a href="/user_refund_requests"/ class="/btn btn-light"/> My refund requests section</a>';                ;
        $notification_ent->save();

        $coinUser = User::where( 'email', 'coins@agrisell.com' )->first();
        $adminUser = User::where( 'email', 'agrisell2077@gmail.com' )->first();
        $currentTime = Carbon::parse( time() )->format( 'M d, Y h:i:s' );
        $status_messages = "Date created: {$currentTime}";

        if ( $coinUser ) {
            $notification_ent = new notification();
            $notification_ent->user_id = $coinUser->id;
            $notification_ent->frm_user_id = auth()->user()->id;
            $notification_ent->notification_title = 'Refund request for ' . $refund_request->refund_ref_id;
            $notification_ent->notification_txt = $status_messages;
            $notification_ent->save();

            event( new ShopEvent( [ 'customer_id' => $coinUser->id ] ) );
        }

        if ( $adminUser ) {
            $notification_ent = new notification();
            $notification_ent->user_id = $adminUser->id;
            $notification_ent->frm_user_id = auth()->user()->id;
            $notification_ent->notification_title = 'Refund request for ' . $refund_request->refund_ref_id;
            $notification_ent->notification_txt = $status_messages;
            $notification_ent->save();
            event( new ShopEvent( [ 'customer_id' => $adminUser->id ] ) );
        }

        // end of notification entity
        return redirect('home')->withMessage('Refund on proccess please wait for the admin and seller');  
    }

    public function admin_refund_change_verification_status(Request $request){
        $refund_request = refundModelOrder::where('id', $request->refund_id)->first();
        $refund_request->prod_refund_status_id = $request->reason_id;
        $price_to_refund = $refund_request->order_item->quantity *  $refund_request->order_item->price;
        $refund_request->save();
        
        // if the refund is success the coins will top up to the user
        // add agricoins same proccess in employee coins top up
        if($request->reason_id == '1'){
            $coinsTopUp_ent = new coinsTopUpEmployeeEntry();
            $coinsTopUp_model_user = new coinsTopUpModel();
            $coinsTopUp_ent->cust_user_id = $refund_request->customer->id;
            $trans_id_coins= 'REFUNDCOINS' . uniqid();
            $coinsTopUp_ent->cust_trans_id = $trans_id_coins;
            $coinsTopUp_ent->coins_trans_type = 'coins_refund';
            $coinsTopUp_ent->value = $price_to_refund;
            $coinsTopUp_ent->status = 'accepted';
            $coinsTopUp_ent->save();

            $coinsTopUp_model_user->user_id = $refund_request->customer->id;
            $coinsTopUp_model_user->trans_id = $trans_id_coins;
            $coinsTopUp_model_user->coins_trans_type = 'coins_refund';
            $coinsTopUp_model_user->remarks = '1';
            $coinsTopUp_model_user->value = $price_to_refund;
            $coinsTopUp_model_user->save();
        }
 
        // notification entity
        $notification_ent = new notification();
        $notification_ent->user_id = Auth::user()->id;
        $notification_ent->frm_user_id = Auth::user()->id;
        $notification_ent->notification_title = 'Refund request for ' . Order::where('id', $refund_request->order_item_id)->first()->order_number;
        $status_name = DB::table('prod_refund_statuses')->where('id', $request->reason_id)->first()->slug;
        $status_messages = '<br>You can check your refund request in the <a href="/user_refund_requests"/ class="/btn btn-light"/> My refund requests section</a>';
        $notification_ent->notification_txt = 'Your refund process for : ' . Product::where('id', $refund_request->product_id)->first()->name . 'is ' . $status_name;
        $notification_ent->save();
        // end of notification entity
        return back();

    }



}
