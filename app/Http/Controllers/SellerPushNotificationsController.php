<?php

namespace App\Http\Controllers;

use App\SellerPayoutRequest;
use App\SubOrder;
use Illuminate\Http\Request;

class SellerPushNotificationsController extends Controller
{
    public function getCounters( Request $request ) {
        $user_id = $request->user_id;

        $pendingPickup = SubOrder::where( 'seller_id', $user_id )->where( 'is_pick_up', 'yes' )->where( 'pick_up_status_id', 1 )->get()->count();
        $pendingDelivery = SubOrder::where( 'seller_id', $user_id )->where( 'is_pick_up', 'no' )->where( 'status_id', 1 )->get()->count();
        $pendingOrders = $pendingPickup + $pendingDelivery;

        $pendingPayout = SellerPayoutRequest::where( 'user_id', $request->user_id )->get()->count();
        
        $data = array(
            array( '#pending--orders', 'Manage Orders', $pendingOrders ),
            array( '#pending--payout', 'Payouts', $pendingPayout )
        );

        return response()->json( [
            'success' => true,
            'data' => $data
        ] );
    }
}
