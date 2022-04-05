
<?php
// test routes
Route::get('/testsite', function(){
    return view('admin_dash.dashboard');
});

Route::get('/testpaper', function(){
    return view('admin.datatables_samp');
});

Route::get('/testchart', function(){
    return view('admin.chart_Test');
});

Route::get('/testtracking', function(){
    return view('order_tracking.order_tracking');
});


Route::get('/testaddress', function(){
    return view('admin.test_blader.testaddress');
});