<?php

 Route::group(['middleware' => 'auth', 'middleware' => 'coins'], function () {
     Route::get('/coins_dashboard', 'CoinsPanelController@index');
     Route::get('/coins_entry', 'CoinsPanelController@coins_entry_form');
     Route::get('/coins_refund', 'CoinsPanelController@coins_refund');
     Route::get('/coins_status', 'CoinsPanelController@coins_status');

     // coins top up submit
     Route::post('/coins_top_up_encode_submit', 'CoinsPanelController@coins_top_up_submit')->name('encode_coins_top_up');
     Route::get('/delete_coins_encode/{coins_top_up_id}', 'CoinsPanelController@coins_top_up_delete');

     // coins top up changelog table
    Route::get('/coinsEmp/coins_top_up/{trans_id}', 'CoinsTopUpAdminController@more_info');
    Route::get('/set_as_verified_coins_top_up/{trans_id}', 'CoinsTopUpAdminController@set_verified');
    // unset will disabled 
    Route::get('/unset_as_verified_coins_top_up/{trans_id}', 'CoinsTopUpAdminController@unset_verified');
    Route::post('/submit_new_coins_top_up', 'CoinsTopUpAdminController@edit_coins_top_up_submit');
    Route::post('/coinsEmp/coins_top_up/submit_edit_amount', 'CoinsTopUpAdminController@submit_edit_amount');
    Route::get('/coinsEmp/delete_coins_top_up/{trans_id}', 'CoinsTopUpAdminController@delete_coins_top_up');


 });