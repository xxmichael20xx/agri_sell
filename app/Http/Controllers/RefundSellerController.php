<?php

namespace App\Http\Controllers;

use App\Events\RefundEvent;
use App\refundModelOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundSellerController extends Controller
{
    public function index() {
        $panel_name = "refunds";
        $requests = refundModelOrder::all();

        return view( 'sellerPanel.refunds.index', compact( 'panel_name', 'requests' ) );
    }

    public function show( $id ) {
        $panel_name = "refund details";
        $refund = refundModelOrder::find( $id );

        return view( 'sellerPanel.refunds.show', compact( 'panel_name', 'refund', 'id' ) );
    }

    public function update( $id, $status ) {
        $refund = refundModelOrder::find( $id );
        $refund->status = $status;
        $refund->save();

        $action = $status == 1 ? "Confirmed" : "Canceled";
        $text = "Refund request #{$id} has been {$action} by Admin.";

        if ( $action == "Confirmed" ) {
            $text .= "<br> Awaiting for Seller approval";
        }

        $notification = [
            'user_id' => $refund->user_id,
            'frm_user_id' => Auth::user()->id,
            'notification_title' => "Refund #{$id} updated",
            'notification_txt' => $text
        ];
        $this->newNotificationWithEvent( $notification, false, [] );

        event( new RefundEvent( [ 'user_id' => $refund->user_id, 'type' => 'refund-update' ] ) );
        return redirect( '/seller/manage_refunds' );
    }
}
