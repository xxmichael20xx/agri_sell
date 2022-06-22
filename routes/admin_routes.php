<?php
Route::group(['middleware' => 'auth', 'middleware' => 'admin'], function () {

    Route::get( '/admin/profile', 'AdminPanelController@profileIndex' );
    Route::post( '/admin/profile/update', 'AdminPanelController@profileUpdate' )->name('admin.profile.update');

    // sidebar menu
    Route::get('/admin', 'AdminPanelController@dashboard');
    Route::get('/admin/valid_ids', 'ValidIdAdminController@index');
    Route::get('/admin/coins_top_up', 'CoinsTopUpAdminController@index');
    Route::get('/admin/manage_shops', 'ShopsAdminController@index');
    Route::get('/admin/manage_users', 'UsersAdminController@index');
    Route::group([ 'prefix' => '/admin/manage_refunds'], function() {
        Route::get( '/', 'RefundAdminController@index' );
        Route::get( '{id}', 'RefundAdminController@show' );
        Route::get( 'update/{id}/{status}', 'RefundAdminController@update' );
    });
    Route::group([ 'prefix' => '/admin/payout'], function() {
        Route::get( '/', 'AdminPayoutController@index' );
        Route::get( '{id}', 'AdminPayoutController@show' );
        Route::post( 'add/proof', 'AdminPayoutController@addProof' )->name( 'admin.payout.proof' );
    });
    Route::get('/admin/manage_orders', 'OrderMgmtPanelController@index');
    
    Route::get('/admin/manage_orders/{status_type}/{status_id}', 'OrderMgmtPanelController@show_by_cat');
    Route::post('/admin/edit_order_status' ,'OrderMgmtPanelController@editOrderStatus')->name('admin.order.update');

    Route::get('/admin/manage_products', 'ProductMgmtPanelController@index');

    // valid id manage routes
    Route::get('/admin/valid_ids/{validId_id}', 'ValidIdAdminController@validIdView');
    Route::get('/set_as_valid_id/{validId_id}', 'ValidIdAdminController@setValidId');
    Route::post('/unset_as_valid_id/{validId_id}', 'ValidIdAdminController@unsetValidId');
    Route::get('/admin/edit_valid_id/{validId_id}', 'ValidIdAdminController@editValidId');
    Route::get('/admin/delete_valid_id/{validId_id}', 'ValidIdAdminController@deleteValidId');
    Route::post('/submit_new_valid_id', 'ValidIdAdminController@validIdEditSubmit');

    //coins top up routes
    Route::get('/admin/coins_top_up/{trans_id}', 'CoinsTopUpAdminController@more_info');
    Route::get('/set_as_verified_coins_top_up/{trans_id}', 'CoinsTopUpAdminController@set_verified');
    Route::get('/unset_as_verified_coins_top_up/{trans_id}', 'CoinsTopUpAdminController@unset_verified');
    Route::post('/submit_new_coins_top_up', 'CoinsTopUpAdminController@edit_coins_top_up_submit');
    Route::post('/admin/coins_top_up/submit_edit_amount', 'CoinsTopUpAdminController@submit_edit_amount');
    Route::get('/admin/delete_coins_top_up/{trans_id}', 'CoinsTopUpAdminController@delete_coins_top_up');


    // manage shop admin routes
    Route::get('/admin/manage_shop/{shop_id}', 'ShopsAdminController@more_info');
    Route::get('/admin/edit_shop/{shop_id}', 'ShopsAdminController@edit_shop_panel');
    Route::get('/admin/delete_shop/{shop_id}', 'ShopsAdminController@delete_shop');
    Route::get('/admin/set_inactive_shop/{shop_id}', 'ShopsAdminController@inactive_shop');
    Route::get('/admin/set_active_shop/{shop_id}', 'ShopsAdminController@active_shop');
    Route::post('/admin/edit_shop_submit/', 'ShopsAdminController@edit_shop_panel_submit');

    // manage users routes
    Route::get('/admin/manage_user/{user_id}', 'UsersAdminController@more_info');
    Route::get('/admin/edit_user/{user_id}', 'UsersAdminController@edit_user_panel');
    Route::post('/user_edit_submit', 'UsersAdminController@edit_user_submit');
    Route::get('/admin/delete_user/{user_id}', 'UsersAdminController@delete_user');

    // manage order routes
    Route::get('/admin_seller/order_type/{order_type}', 'OrderMgmtPanelController@show_order_panel');
    Route::get('/admin_seller/order/{order_num}', 'OrderMgmtPanelController@show');
    // is order paid?
    Route::get('/admin_seller/mark_as_paid/{order_num}', 'OrderMgmtPanelController@setOrderPaid');
    Route::get('/admin_seller/mark_as_unpaid/{order_num}', 'OrderMgmtPanelController@setOrderUnPaid');
    // assign rider
    Route::get('/assign_rider/{rider_id}/{order_id}', 'OrderMgmtPanelController@assignRiderOrder');
    // edit order delivery statuse
    Route::get('/admin/edit_order_status/{status_id}/{order_id}', 'OrderMgmtPanelController@markOrderDeliveryStatus');
    Route::get('/admin/edit_pickup_status/{status_id}/{order_id}', 'OrderMgmtPanelController@markOrderPickUpStatus');

    // manage products
    Route::get('/admin_seller/product_info/{product_id}', 'ProductMgmtPanelController@show');
    Route::get('/admin_seller/delete_product/{product_id}', 'ProductMgmtPanelController@delete');
    Route::get('/admin_seller/product_edit/{product_id}', 'ProductMgmtPanelController@edit');
    Route::get('/admin_seller/add_new_product/', 'ProductMgmtPanelController@add_new_display_form')->name('add_new_product_admin');
    Route::post('/admin_seller/product_edit_submit/', 'ProductMgmtPanelController@saveProduct_edit_form')->name('edit_product_admin');
    Route::post('/admin_seller/product_add_submit/', 'ProductMgmtPanelController@saveProduct_add_form')->name('add_new_product_submit_admin');

    Route::get('/seller/hide_product/{product_id}', 'ProductMgmtPanelController@hide_product');
    // products monitoring
    Route::get('/admin/product_order_monitoring', 'ProductsMonitoringController@index');
    Route::get('/admin_product_monitor/products/{order_id}', 'ProductsMonitoringController@show');

    // single products monitoring
    Route::get('/admin_product_monitor/{suborder_item_id}', 'OrderMgmtPanelController@showSingleSubItemSingle');

    // admin_seller validation
    Route::get('/admin/sell_reg_fees', 'sellRegController@admin_panel_index');
    Route::get('/admin/sell_reg_more_info/{sell_reg_id}', 'sellRegController@admin_panel_more_info');
    Route::get('/admin/sell_reg_delete/{sell_reg_id}', 'sellRegController@admin_panel_deleted');
    Route::post('/admin/change_seller_verification_status', 'sellRegController@change_verification_status')->name('change_seller_verification_status');
    
    // revisi march 13 2022
    Route::get('/admin/sell_reg_approved/{sell_reg_id}', 'sellRegController@sell_reg_approved');
    Route::get('/admin/sell_reg_declined/{sell_reg_id}', 'sellRegController@sell_reg_declined');
    
    // admin transaction history
    Route::get('/admin/transaction_history', 'sellRegController@admin_panel_index');

    // declined sell reg status
    Route::post('/invalid_sell_reg_status_remarks', 'sellRegController@invalidSellRegStatusNotif');
    
    // pre order routes
    Route::get('/admin/pre_orders', 'PreOrderController@index');
    Route::post('/admin/confirm_ord_frm_pre_order', 'OrderController@storefromPreOrder')->name('confirmOrderfrmPreOrderAdmin');
    
    Route::get('/admin/delete_pre_order/{pre_order_req_id}', 'PreOrderController@delete');

    // manage transaction history
    Route::get('/admin/trans_hist', 'TransactionHist@index');

    // refund management 
    Route::get('/admin/refund_management', 'refundController@admin_refund_mgmt_index');
    Route::get('/admin_refund/more_info/{refund_req_id}', 'refundController@admin_refund_mgmt_view');
    Route::post('/admin_set_product_refund_status', 'refundController@admin_refund_change_verification_status');  

    // admin notifications
    Route::get('/admin/notifications', 'adminNotifController@index');

    // rider management routes
    Route::get('/admin/rider_management', 'riderMgmtController@index');
    Route::get('/admin/rider_management/edit/{id}', 'riderMgmtController@edit');
    Route::get('admin/remove_rider/{user_id}', 'riderMgmtController@remove_rider');

    Route::post('/admin/rider_new_add', 'riderMgmtController@add_new')->name('rider_mgmt_add');
    Route::post('/admin/rider_new_update', 'riderMgmtController@update_rider')->name('rider_mgmt_update');

    Route::get('/admin/rider_registration', 'riderMgmtController@add_new_form');

    // Report Generation Routes
    Route::group( [ 'prefix' => 'export/csv' ], function() {
        // Activity Logs
        Route::get( 'activity-logs', 'ReportGenerationCsvController@activityLogs' );

        // Refunds
        Route::group( [ 'prefix' => 'refunds' ], function() {
            Route::get( '{type}/{interval}', 'ReportGenerationCsvController@refunds' );
        } );

        // Shops
        Route::group( [ 'prefix' => 'shops' ], function() {
            Route::get( '{interval}/{type}', 'ReportGenerationCsvController@shops' );
        } );

        // Users
        Route::group( [ 'prefix' => 'users' ], function() {
            Route::get( '{interval}/{role_id}', 'ReportGenerationCsvController@users' );
        } );

        // Users
        Route::group( [ 'prefix' => 'payouts' ], function() {
            Route::get( '{status_id}/{interval}', 'ReportGenerationCsvController@payouts' );
        } );

        // Users
        Route::group( [ 'prefix' => 'orders' ], function() {
            Route::get( '{type}/{interval}', 'ReportGenerationCsvController@orders' );
        } );
    } );

    Route::group( [ 'prefix' => 'export/pdf' ], function() {
        Route::get( 'activity-logs', 'ReportGenerationPdfController@activityLogs' );
    } );
});
