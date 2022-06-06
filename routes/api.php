<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ 'prefix' => 'notifications' ], function() {
    Route::get( 'count/{id}', 'NotificationsController@getNotificationsCount' );
});

Route::group([ 'prefix' => 'admin' ], function() {
    Route::post( 'pending/shops', 'AdminPushNotifications@pendingShops' );
    Route::post( 'verification/ids', 'AdminPushNotifications@userIdVerification' );
    Route::post( 'pending/refunds', 'AdminPushNotifications@pendingRefunds' );
    Route::post( 'rider/verify', 'riderMgmtController@riderVerify' );
    Route::post( 'refund/reject/{id}', 'RefundAdminController@refundReject' );

    Route::group([ 'prefix' => 'payout' ], function() {
        Route::post('update', 'AdminPayoutController@update');
    });
});

Route::group([ 'prefix' => 'seller' ], function() {
    Route::post( 'push/notifications', 'SellerPushNotificationsController@getCounters' );
    Route::post( 'restore-product', 'ProductMgmtPanelController@restoreProduct' );
    Route::post( 'delete-product/{id}', 'ProductMgmtPanelController@deleteProduct' );

    Route::group([ 'prefix' => 'payout' ], function() {
        Route::post('verify', 'SellerPayoutController@verify');
        Route::post( 'validation', 'SellerPayoutController@validation');
        Route::post( 'new', 'SellerPayoutController@createRequest');
    });
});
