<?php

namespace App\Http\Controllers;

use App\Events\RefundEvent;
use App\refundModelOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RefundSellerController extends Controller
{
    public function index() {
        $panel_name = "- Refunds";
        $refunds = refundModelOrder::all();
        $pendingRefunds = refundModelOrder::where( 'status', '1' )->get()->count();

        return view( 'sellerPanel.refunds.index', compact( 'panel_name', 'refunds', 'pendingRefunds' ) );
    }

    public function show( $id ) {
        $panel_name = "refund details";
        $refund = refundModelOrder::find( $id );

        return view( 'sellerPanel.refunds.show', compact( 'panel_name', 'refund', 'id' ) );
    }

    public function update( $id, $status, $reason = NULL, $admin_id = 1 ) {
        $refund = refundModelOrder::find( $id );
        $refund->status = $status;

        if ( $reason ) $refund->reason = $reason;
        $refund->save();

        $action = $status == 3 ? "Confirmed" : "Canceled";
        $title = "Refund #{$id} updated";
        $text = "Refund request #{$id} has been {$action} by Seller.";

        if ( $status == 3 ) {
            $item = $refund->order_item;
            $refundAmount = round( ( $item->price * $item->quantity ) / 2 );

            $text .= "<br> ₱ {$refundAmount} has been added to your Agri Coins";
            $title = "Refund #{$id} confirmed";

            $topUp = DB::table('coins_top_up')->insert([
                'user_id' => $refund->user_id,
                'trans_id' => "REFUND-{$refund->id}",
                'coins_trans_type' => 'gcash',
                'invalid_reason' => 'N/A',
                'reference_id' => 'N/A',
                'approved_by_user_id' => 3,
                'remarks' => 1,
                'image_proof' => 'coinsTopUp\Refund-bro.png',
                'value' => $refundAmount
            ]);
        }

        $notification = [
            'user_id' => $refund->user_id,
            'frm_user_id' => Auth::user()->id ?? $admin_id,
            'notification_title' => $title,
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
        return redirect( '/sellerpanel/refunds' );
    }

    public function refundReject( Request $request, $id ) {
        return $this->update( $id, 4, $request->reason, $request->user_id );
    }
}
