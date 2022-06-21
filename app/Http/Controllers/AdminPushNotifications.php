<?php

namespace App\Http\Controllers;

use App\refundModelOrder;
use App\seller_reg_fee;
use App\SellerPayoutRequest;
use App\Shop;
use App\UserValidId;
use Illuminate\Http\Request;

class AdminPushNotifications extends Controller
{
    /**
     * Check if current user is admin
     * 
     * @return Array
     */
    public function hasAccess( Request $request ) {
        $validate = $this->userCan( $request->user_id, 1 );
        if ( ! $validate ) {
            return response()->json( [
                'success' => false
            ] );
        }
    }

    /**
     * Get the count of the pending shops
     * 
     * @return Array
     */
    public function pendingShops( Request $request ) {
        $this->hasAccess( $request );
        
        $shops = seller_reg_fee::where( 'status', 0 )->get()->count();
        return response()->json( [
            'success' => true,
            'data' => $shops
        ] );
    }

    /**
     * Get the count of the users for verification
     * 
     * @return Array
     */
    public function userIdVerification( Request $request ) {
        $this->hasAccess( $request );

        $forVerification = UserValidId::where( 'is_valid', 2 )->get()->count();
        return response()->json( [
            'success' => true,
            'data' => $forVerification
        ] );
    }

    /**
     * Get the count of the pending refunds
     * 
     * @return Array
     */
    public function pendingRefunds( Request $request ) {
        $this->hasAccess( $request );
        
        $refunds = refundModelOrder::where( 'status', 0 )->get()->count();
        return response()->json( [
            'success' => true,
            'data' => $refunds
        ] );
    }

    /**
     * Get the count of the pending payouts
     * 
     * @return Array
     */
    public function pendingPayouts( Request $request ) {
        $this->hasAccess( $request );
        
        $payouts = SellerPayoutRequest::where( 'status', 0 )->get()->count();
        return response()->json( [
            'success' => true,
            'data' => $payouts
        ] );
    }
}
