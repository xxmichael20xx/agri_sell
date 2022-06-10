<?php

namespace App\Http\Controllers;

use App\Events\RefundEvent;
use App\refundModelOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundAdminController extends Controller
{
    public function index() {
        $panel_name = "refunds";
        $refunds = refundModelOrder::all();

        return view( 'admin.refunds.index', compact( 'panel_name', 'refunds' ) );
    }

    public function show( $id ) {
        $panel_name = "refund details";
        $refund = refundModelOrder::find( $id );

        return view( 'admin.refunds.show', compact( 'panel_name', 'refund', 'id' ) );
    }

    public function update( $id, $status, $reason = NULL, $admin_id = 1 ) {
        $refund = refundModelOrder::find( $id );
        $refund->status = $status;

        if ( $reason ) $refund->reason = $reason;

        $refund->save();

        $action = $status == 1 ? "Confirmed" : "Canceled";
        $text = "Refund request #{$id} has been {$action} by Admin.";

        if ( $action == "Confirmed" ) {
            $text .= "<br> YOUR REFUND REQUEST IS CONFIRMED";
            $text .= "<br> Awaiting for Seller approval";
        }

        if ( $reason ) {
            $text .= "<br> YOUR REFUND REQUEST IS REJECTED";
            $text .= "<br> Reason: " . $reason;
        }

        $notification = [
            'user_id' => $refund->user_id,
            'frm_user_id' => Auth::user()->id ?? $admin_id,
            'notification_title' => "Refund #{$id} - {$action}",
            'notification_txt' => $text
        ];
        $this->newNotificationWithEvent( $notification, false, [] );

        event( new RefundEvent( [ 'user_id' => $refund->user_id, 'type' => 'refund-update' ] ) );

        if ( $reason ) {
            return response()->json([
                'success' => true,
                'message' => 'Refund request has been rejected!'
            ]);
        }
        return redirect( '/admin/manage_refunds' );
    }

    public function refundReject( Request $request, $id ) {
        $status = $request->status ?? 2;
        $reason = $request->reject_reason == 'Others' ? 'Others: ' . $request->reject_reason_others : $request->reject_reason;
        return $this->update( $id, $status, $reason, $request->user_id );
    }
}
