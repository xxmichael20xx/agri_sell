<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use App\Shop;
use App\User;
use App\seller_reg_fee;
use App\notification;
use App\adminNotifModel;
use App\Events\ShopEvent;
use App\TransHistModel;
class sellRegController extends Controller
{
    // remarks about
    // 1 paid
    // 2 invalid 
    // 4 for verification
    function admin_panel_index(){
        $users = seller_reg_fee::where( 'status', 0 )->where( 'trans_id', '!=', '' )->where( 'payment_proof', '!=', '' )->get();

        foreach ( $users as $user_index => $user ) {
            if ( ! $user->owner ) $users->forget( $user_index );
        }

        $panel_name = "- Seller Registration";
        return view('admin.sell_reg_fees.index')->with(compact('users', 'panel_name'));
    }

    function set_sell_reg_status($sell_reg_id, $status_id){


    }
   // remarks about
    // 1 paid
    // 2 invalid 
    // 4 for verification
    function sell_reg_declined($sell_reg_id){
        $sell_reg_fee_inst = seller_reg_fee::where('id', $sell_reg_id)->first();
        $sell_reg_fee_inst->status = '2';
        $sell_reg_fee_inst->save();

        // then update shop
        Shop::where('user_id', $sell_reg_fee_inst->user_id)->delete();
        
        $user = User::where('id', $sell_reg_fee_inst->user_id)->first();
        $user->role_id = '2';
        
        // notification entity of sell reg declined
        $notification_ent = new notification();
        $notification_ent->user_id = $sell_reg_inst->owner->id ?? 'not available';
        $notification_ent->frm_user_id = Auth::user()->id;
        $notification_ent->notification_title = 'Seller registration fee status';
        $notification_ent->notification_txt = 'Invalid seller amount please register your shop again';
        $notification_ent->save();

        return back();
    }
     
    function sell_reg_approved($sell_reg_id){
        // sel reg approved mar 14 2022
        $sell_reg_fee_inst = seller_reg_fee::where('id', $sell_reg_id)->first();
        $sell_reg_fee_inst->status = '1';
        $sell_reg_fee_inst->save();

        // then update shop
        $shop = Shop::where('user_id', $sell_reg_fee_inst->user_id)->first();
        $shop->is_active = '1';
        $shop->date_approved = date("Y/m/d") . ' ' .  date("h:i:sa");
        $shop->save();

        // then change user level of the user
        $user_model = User::where('id', $sell_reg_fee_inst->user_id)->first();
        $user_model->role_id = '3';
        $user_model->save();
        
          // notification entity for sell reg approved mar 14 2022
        $notification_ent = new notification();
        $notification_ent->user_id = $sell_reg_fee_inst->owner->id ?? 'not available';
        $notification_ent->frm_user_id = Auth::user()->id;
        $notification_ent->notification_title = 'Seller registration fee status';
        $notification_ent->notification_txt = 'Your shop is approved you may now open<br>your shop in the <a class="btn btn-primary" href="/sellerpanel">Seller panel</a>';
        $notification_ent->save();
  
        return back();
    }

    function invalidSellRegStatusNotif( Request $request ) {
        $sell_reg_fee_inst = seller_reg_fee::find( $request->sell_reg_id );
        $sell_reg_fee_inst->status = '2';
        $sell_reg_fee_inst->save();

        // then update shop
        // Shop::where( 'user_id', $sell_reg_fee_inst->user_id )->delete();
        
        // set to regular user
        $user = User::find( $sell_reg_fee_inst->user_id );
        $user->role_id = '2';
        $user->save();

        $reason = ucwords( str_replace( '_', ' ', $request->invalid_sell_reg_status ) );

        if ( $request->invalid_sell_reg_status == 'Others' ) {
            $reason = "Others: " . $request->invalid_sell_reg_status_others;
        }
        
        $reason .= "
            <br>
            <a href='/seller_center' style='color: #28A745;'>Try Again</a>
        ";

        // notification entity of sell reg declined
        $notification_ent = new notification();
        $notification_ent->user_id =  $sell_reg_fee_inst->user_id;
        $notification_ent->frm_user_id = auth()->user()->id;
        $notification_ent->notification_title = 'Seller registration fee status';
        $notification_ent->notification_txt = 'Invalid seller amount. Please register your payment again. <br>Reason: ' . $reason;
        $notification_ent->save();

        return redirect( '/admin/sell_reg_fees' )->with( 'info', "Seller Registration #{$request->sell_reg_id} has been marked as invalid." );
    }

   function change_verification_status(Request $request){
        $sell_reg_inst = seller_reg_fee::where('id', $request->inst_id)->first();
        $sell_reg_inst_owner = User::find($sell_reg_inst->owner->id);
        if($request->sell_reg_status == '1'){
             $sell_reg_inst_owner->role_id = '3';
        }
        $sell_reg_inst_owner->save();
        $sell_reg_inst->status = $request->sell_reg_status;

        $sell_reg_ver_invalid_reason_id = $request->sell_reg_ver_invalid_reason_id ?? '4'; 
        // detect invalid
        if ($request->sell_reg_status == '3') {
            $sell_reg_ver_invalid_reason_id = $request->sell_reg_ver_invalid_reason_id;
        }else{
        // not invalid
            $sell_reg_ver_invalid_reason_id = '4';
        }
        
        $sell_reg_inst->invalid_reason_id_status = $sell_reg_ver_invalid_reason_id;
        $sell_reg_status_ent = DB::table('seller_payment_reg_rem')->where('id', $request->sell_reg_status)->first();

        // notification entity
        $notification_ent = new notification();
        $notification_ent->user_id = $sell_reg_inst->owner->id ?? 'not available';
        $notification_ent->frm_user_id = Auth::user()->id;
        $notification_ent->notification_title = 'Seller registration fee status';
        $notification_ent->notification_txt = 'Your verification status is: ' . $sell_reg_status_ent->remarks;
        $notification_ent->save();
        // end of notification entity
        $sell_reg_inst->save();
        return back();
    }

    function admin_panel_more_info( $sell_reg_id ) {
        $user = seller_reg_fee::find( $sell_reg_id );
        $panel_name = "- Seller Registration Information";

        return view( 'admin.sell_reg_fees.more_info' )->with( compact( 'user', 'panel_name' ) );
    }
    
    function save_new_vendor(Request $req)
    {
        // create a new shop
        $shop = new Shop;
        $shop->user_id = Auth::user()->id;
        $shop->name = $req->shopName;
        $shop->description = $req->shopDesc;
        // set shop as not active yet
        $shop->is_active = '0';
        $shop->save();

        // updating user role
        $user = User::find( Auth::user()->id );
        // set the registration role to not yet seller first
        $user->role_id = 4;
        $user->save();

        $seller_reg_fee = new seller_reg_fee;
        $seller_reg_fee->user_id = Auth::user()->id;
        $seller_reg_fee->trans_id = ''; 
        $seller_reg_fee->payment_proof = '';
        $seller_reg_fee->status = 0;
        $seller_reg_fee->save();

        event( new ShopEvent( [ 'type' => 'new-pending-shop' ] ) );

        // add a record to seller_registration
        return redirect('/registration_fee_instructions');
    }

    // when user click submit payment in seller registration
    function confirm_registration_fee( Request $request ) {
        $this->validate( $request, [
            'proofSellRegPayment' => 'required',
            'trans_code' => [ 'required', 'unique:seller_registration_fee,trans_id' ]
        ] );

        $proofSellRegPaymentImage = $request->file('proofSellRegPayment');
        $proofImageSaveAsName = time() . uniqid() . "-paymentSellReg." . $proofSellRegPaymentImage->getClientOriginalExtension();
        
        $upload_path = 'storage/seller-registration-fee/' . date('FY') . '/';

        $proof_image_url = 'seller-registration-fee\\' . date('FY') . '\\' . $proofImageSaveAsName;
        $success = $proofSellRegPaymentImage->move($upload_path, $proofImageSaveAsName);

        $seller_reg_fee = seller_reg_fee::where('user_id', auth()->user()->id)->first();
        $_payment_proof = $seller_reg_fee->payment_proof;
        $_trans_id = $seller_reg_fee->trans_id;

        $seller_reg_fee->payment_proof = $proof_image_url;
        $seller_reg_fee->trans_id = $request->trans_code;
        $seller_reg_fee->status = 0;
        $seller_reg_fee->save();

        $trans = new TransHistModel();
        $trans->user_id_master = auth()->user()->id;
        $trans->user_id_slave = '1';
        $trans->remarks = 'The user registers to be a';
        $trans->trans_type = 'Seller Registration';
        $trans->trans_ref_id = 'SELLREG-' . uniqid();
        $trans->amount = '100';
        $trans->save();

        /* $request = request();

        $valid_idImage = $request->file('valid_id');
        $valid_idImageSaveAsName = time() . uniqid() . "-valid_id." . $valid_idImage->getClientOriginalExtension();

        $upload_path_url = 'user-valid-ids\\' . date('FY') . '\\';
        $valid_id_image_url = $upload_path_url . $valid_idImageSaveAsName;

        $success = $valid_idImage->move($upload_path, $valid_idImageSaveAsName); */
       
        // set a notification table
        // notify admin that the user registers
        // in accordance to suggestion 
        $adminnotif_ent = new adminNotifModel();
        $adminnotif_ent->action_type = 'Seller registration';
        $adminnotif_ent->user_id = Auth::user()->id;
        $adminnotif_message = Auth::user()->name . ' registers a shop confirm the seller registration fee in the admin panel <a class="btn btn-light" href="/admin/sell_reg_more_info/' . $seller_reg_fee->id . '">More info</a>';
        $adminnotif_ent->action_description = $adminnotif_message; 
        $adminnotif_ent->save();

        $admin = User::where( 'email', 'agrisell2077@gmail.com' )->first();
        $notification_ent = new notification();
        $notification_ent->user_id = $admin->id;
        $notification_ent->frm_user_id = auth()->user()->id;

        if ( ! $_payment_proof || empty( $_payment_proof ) ) {
            $this->adminPushNotifications( [
                'title' => "New Shop Registration",
                'message' => $adminnotif_message
            ] );

        } else {
            $this->adminPushNotifications( [
                'title' => "Shop Registration - Payment Update",
                'message' => Auth::user()->name . ' changes the payment for their shop registration. Click the button for more information <a class="btn btn-light" href="/admin/sell_reg_more_info/' . $seller_reg_fee->id . '">More info</a>'
            ] );
        }

        return redirect('home');
    }

    function complete_seller_reg(){
        // updating user role
        $user = User::find(Auth::user()->id);
        // set the registration role to not yet seller first
        // $user->role_id = '3';
        $user->save();
        return redirect('home');
        // return redirect('home');
    }


    function admin_panel_deleted( $sell_reg_id ) {
        $seller = seller_reg_fee::find( $sell_reg_id) ;
        $user_id = $seller->user_id;
        $seller->delete();

        $user = User::find( $user_id );
        $user->role_id = 2;
        $user->save();

        return back()->with( 'info', "Seller Registration of User #{$user_id} has been deleted!" );
    }

}
