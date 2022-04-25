<?php

namespace App\Http\Controllers;

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
        
        $shops = Shop::where( 'is_active', false )->get()->count();
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
}
