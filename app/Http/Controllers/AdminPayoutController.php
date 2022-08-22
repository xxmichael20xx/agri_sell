<?php

namespace App\Http\Controllers;

use App\Events\PayoutEvent;
use App\notification;
use App\SellerPayoutRequest;
use Illuminate\Http\Request;

class AdminPayoutController extends Controller
{
    public function index() {
        $panel_name = "payout";
        $payouts = SellerPayoutRequest::all();

        return view( 'admin.payout.index', compact( 'panel_name', 'payouts' ) );
    }

    public function show( $id ) {
        $panel_name = "payout details";
        $payout = SellerPayoutRequest::find( $id );

        return view( 'admin.payout.show', compact( 'panel_name', 'payout', 'id' ) );
    }

    public function update( Request $request ) {
        $payout = SellerPayoutRequest::find( $request->id );
        $payout->status = $request->status;
        $payout->reject_reason = NULL;
        $data = [
            'success' => true,
            'message' => 'Payout request has been confirmed!'
        ];
        $text = "Payout request has been confirmed!";

        if ( $request->status == '2' ) {
            $payout->reject_reason = $request->reason;
            $text = "Payout request has been rejected!<br>Reason - {$request->reason}";
            $data = [
                'success' => false,
                'message' => "Payout request has been rejected!"
            ];
        }
        $payout->save();

        $adminNotification = new notification();
        $adminNotification->user_id = $payout->user_id;
        $adminNotification->frm_user_id = $request->user_id;
        $adminNotification->notification_title = "[Admin] Payout Request Update";
        $adminNotification->notification_txt = $text;
        $adminNotification->save();

        $emailData = [
            'id' => $payout->user_id,
            'subject' => $adminNotification->notification_title,
            'details' => $adminNotification->notification_txt
        ];
        $this->sendEmailNotif( $emailData );

        event( new PayoutEvent( [ 'user_id' => $payout->user_id ] ) );
        
        return response()->json( $data );
    }

    public function addProof( Request $request ) {
        if ( $request->hasFile( 'proof' ) ) {
            $proof = $request->proof;
            $proofSaveAs = time() . uniqid() . "-payout-proof." . $proof->getClientOriginalExtension();
            $upload_path = 'storage/payout/proof/' . date('FY') . '/';
            $upload_path_url = 'payout/proof//' . date('FY') . '//';
            $product_image_url = $upload_path_url . $proofSaveAs;
            $proof->move( $upload_path, $proofSaveAs );

            $payout = SellerPayoutRequest::find( $request->id );
            $payout->image_proof = $product_image_url;
            $payout->save();

            return back()->with( 'proof_info', 'Proof of payout has been uploaded.' );
        }

        return back()->with( 'proof_info', 'Proof of payout is required.' );
    }
}
