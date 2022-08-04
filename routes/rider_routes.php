<?php
Route::group(['middleware' => 'auth', 'middleware' => 'rider'], function () {
    Route::get('/rider_dashboard/{type?}', 'RiderPanelController@index');
    // manage order routes

    Route::get('/rider/order/{order_num}', 'RiderPanelController@show_seller_order');
    Route::get('/rider/mark_as_paid/{order_num}', 'RiderPanelController@setOrderPaid');
    Route::get('/rider/mark_as_unpaid/{order_num}', 'RiderPanelController@setOrderUnPaid');

    // Route::get('/edit_order_status/{option_id}/{order_id}', 'RiderPanelController@setOrderStatus');

    // Route::get('/test_order_route/{opt_id}', 'RiderPanelControlller@sellerStatus');
    // Route::get('/rider_edit_order_status/{option_id}/{order_id}', 'RiderPanelController@setOrderStatus');

    Route::get('/product_monitoring_status/{suborder_item_id}/', 'OrderMgmtPanelController@showSingleSubItemSingle');

    // Report Generation Routes
    Route::group( [ 'prefix' => '/export/csv/rider' ], function() {
        // Deliveries
        Route::group( [ 'prefix' => 'deliveries' ], function() {
            Route::get( '{type}', 'ReportGenerationCsvController@riderDeliveries' );
        } );
    });

    // Report Generation Routes
    Route::group( [ 'prefix' => '/export/pdf/rider' ], function() {
        // Deliveries
        Route::group( [ 'prefix' => 'deliveries' ], function() {
            Route::get( '{type}', 'ReportGenerationPdfController@riderDeliveries' );
        } );
    });
});
