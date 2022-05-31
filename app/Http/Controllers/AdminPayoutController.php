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

        event( new PayoutEvent( [ 'user_id' => $payout->user_id ] ) );
        
        return response()->json( $data );
    }
}
