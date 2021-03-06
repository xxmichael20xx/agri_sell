<?php

Route::group(['middleware' => 'auth', 'middleware' => 'seller'], function () {
    Route::get('/sellerpanel', 'SellerPanelController@index');

    Route::get('/sellerpanel/orders', 'SellerPanelController@order_index');
    Route::get('/sellerpanel/orders/{order_id}', 'SellerPanelController@show_seller_order');
   
    // pre order routes
    Route::get('/sellerpanel/pre_orders', 'PreOrderController@index');
    Route::post('/sellerpanel/confirm_ord_frm_pre_order', 'OrderController@storefromPreOrder')->name('confirmOrderfrmPreOrderSeller');
    Route::get('/sellerpanel/delete_pre_order/{pre_order_req_id}', 'PreOrderController@delete');


    // manage order routes
    Route::get('/seller/order/{order_num}', 'OrderMgmtPanelController@show_seller_order');
    // is order paid?
    Route::get('/seller/mark_as_paid/{order_num}', 'OrderMgmtPanelController@setOrderPaid');
    Route::get('/seller/mark_as_unpaid/{order_num}', 'OrderMgmtPanelController@setOrderUnPaid');
    // assign rider
    Route::get('/assign_rider/{rider_id}/{order_id}', 'OrderMgmtPanelController@assignRiderOrder');
    // edit order delivery status
    Route::get('/edit_order_status/{status_id}/{order_id}', 'OrderMgmtPanelController@markOrderDeliveryStatus');
    // edit order pickup status
    Route::get('/edit_pickup_status/{status_id}/{order_id}', 'OrderMgmtPanelController@markOrderPickUpStatus');
    Route::post('/edit_order_status' ,'OrderMgmtPanelController@editOrderStatus')->name('order.order.update');

    Route::get('/sellerpanel/manage_orders/{status_type}/{status_id}', 'SellerPanelController@show_by_cat');
   
    // seller product monitor setter
    Route::get('/seller_product_monitor/{suborder_item_id}', 'OrderMgmtPanelController@showSingleSubItemSingle');
   

    // manage products
    Route::get('/sellerpanel/products', 'ProductMgmtPanelController@index');
    Route::get('/sellerpanel/product_info/{product_id}', 'ProductMgmtPanelController@show');
    Route::get('/sellerpanel/delete_product/{product_id}', 'ProductMgmtPanelController@delete');
    Route::get('/sellerpanel/product_edit/{product_id}', 'ProductMgmtPanelController@edit');

    // default add new display form of Regular product
    Route::get('/sellerpanel/add_new_product/regular', 'ProductMgmtPanelController@add_new_display_form_regular');
    // default add new display form of Variation product
    Route::get('/sellerpanel/add_new_product/productVariation', 'ProductMgmtPanelController@add_new_display_form_product_variation');
    // restore product page
    Route::get('/sellerpanel/restore/{id}', 'ProductMgmtPanelController@restoreForm');

    // submit of add new display form of Regular product
    // Route::post('/sellerpanel/product_save_info/regular', 'ProductMgmtPanelController@save_new_display_form_regular')->name('save_new_product_regular');
    Route::post('/sellerpanel/product_save_info/regular', 'ProductMgmtPanelController@save_new_products_v2')->name('save_new_products');
    Route::post('/sellerpanel/update_info', 'ProductMgmtPanelController@update_product_v2')->name('update_product_v2');

    // submit of add new display form of Variation product
    Route::post('/sellerpanel/product_save_info/variation', 'ProductMgmtPanelController@add_new_display_form_variation')->name('save_new_product_variation');

    Route::post('/sellerpanel/product_edit_submit/', 'ProductMgmtPanelController@saveProduct_edit_form')->name('edit_product_sell');
    Route::post('/sellerpanel/product_add_submit/', 'ProductMgmtPanelController@saveProduct_add_form')->name('add_new_product');
   

    Route::post('/sellerPanel/add_new_product_regular/', 'ProductMgmtPanelController@saveNewProductRegular')->name('add_new_product_regular');
    Route::post('/sellerPanel/add_new_product_variations/', 'ProductMgmtPanelController@saveNewProductVariation')->name('add_new_product_variation');

    Route::group([ 'prefix' => '/sellerpanel/refunds' ], function() {
        Route::get( '/', 'RefundSellerController@index');
        Route::get( '{id}', 'RefundSellerController@show' );
        Route::get( 'update/{id}/{status}', 'RefundSellerController@update' );
    });

    Route::group([ 'prefix' => '/sellerpanel/payout' ], function() {
        Route::get( '/', 'SellerPayoutController@index');
        Route::get( 'show/{id}', 'SellerPayoutController@show');
        Route::get( 'new/{id?}', 'SellerPayoutController@new');
    });

    // Report Generation Routes
    Route::group( [ 'prefix' => '/export/csv/seller' ], function() {
        // Products
        Route::group( [ 'prefix' => 'products' ], function() {
            Route::get( '{type}/{interval}/{month?}', 'ReportGenerationCsvController@sellerProducts' );
        } );

        // Refunds
        Route::group( [ 'prefix' => 'refunds' ], function() {
            Route::get( '{type}/{interval}/{month?}', 'ReportGenerationCsvController@sellerRefunds' );
        } );

        // Refunds
        Route::group( [ 'prefix' => 'payouts' ], function() {
            Route::get( '{interval}/{month?}', 'ReportGenerationCsvController@sellerPayouts' );
        } );
    });

    // Report Generation Routes
    Route::group( [ 'prefix' => '/export/pdf/seller' ], function() {
        // Products
        Route::group( [ 'prefix' => 'products' ], function() {
            Route::get( '{type}/{interval}/{month?}', 'ReportGenerationPdfController@sellerProducts' );
        } );

        // Refunds
        Route::group( [ 'prefix' => 'refunds' ], function() {
            Route::get( '{type}/{interval}/{month?}', 'ReportGenerationPdfController@sellerRefunds' );
        } );

        // Refunds
        Route::group( [ 'prefix' => 'payouts' ], function() {
            Route::get( '{interval}/{month?}', 'ReportGenerationPdfController@sellerPayouts' );
        } );
    });
});

 // sidebar menu

