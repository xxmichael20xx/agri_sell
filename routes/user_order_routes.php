<?php

Route::get('/my_orders/home', function(){
    return view('user_orders.index');
});
Route::get('/my_orders/all', 'UserOrderMgmtPanelController@all');



Route::get('/my_orders/{status_type}/{status_id}', 'UserOrderMgmtPanelController@show_by_cat');
