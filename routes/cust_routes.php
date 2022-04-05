<?php 
Route::get('/email_sampler', function(){
    $test_var = 'lickert';
    Mail::to('gtdbuoocplmznhvgra@nvhrw.com')->send(new otpsenderemail($test_var));
    return new otpsenderemail();
});

Route::get('/test_form_dynamic', function(){
    return view('test_dynamic.add_forrm_dynamically');
});