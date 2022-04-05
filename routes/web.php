<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;
use App\Mail\otpsenderemail;
use Illuminate\Support\Facades\Mail;


// Route::redirect('/', '/home');
Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contact', 'HomeController@contact')->name('contact');

Route::get('/products/home', 'ProductController@home');

Route::get('/products/search', 'ProductController@search')->name('products.search');
Route::get('/pre_sale_products/show', 'ProductController@presale_show')->name('pre_sale_product.show');

// refund routes
Route::get('/product_refund_request_user/{order_id}/{order_item_id}', 'refundController@refund_request_order');
Route::post('/product_refund_submit', 'refundController@refund_request_order_confirm')->name('refund_request');
Route::get('/user_refund_requests', 'refundController@refund_index');
Route::get('/otp_request_orders', 'otprequestMgmtController@otp_request_index');

Route::resource('products', 'ProductController');

// old add to card product by quantity
Route::get('/add-to-cart/{product}', 'CartController@add')->name('cart.add')->middleware('auth');
// add to cart with quantity
Route::get('/add-to-cart-quantity/{product}', 'CartController@addWquantity')->name('cart.addwithquantity')->middleware('auth');

// add to cart with quantity and attributes such as color size and blah blah blah
Route::get('/add-to-cart-attributes/{product}', 'CartController@addWqtyattributes')->name('cart.addwithattributes')->middleware('auth');

// add to cart with quantity and product variation 
Route::get('/add-to-cart-variation/{product}', 'CartController@addWquantityVariation')->name('cart.addWquantityVariation')->middleware('auth');

// Route::post('/add-to-cart/{product}', 'CartController@add')->name('cart.add')->middleware('auth');
Route::get('/cart', 'CartController@index')->name('cart.index')->middleware('auth');
Route::get('/cart/destroy/{itemId}', 'CartController@destroy')->name('cart.destroy')->middleware('auth');
Route::get('/cart/update/{itemId}', 'CartController@update')->name('cart.update')->middleware('auth');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout')->middleware('auth');
Route::get('/cart/apply-coupon', 'CartController@applyCoupon')->name('cart.coupon')->middleware('auth');

Route::resource('orders', 'OrderController')->middleware('auth');
//Route::resource('shops','ShopController')->middleware('auth');

//shop catalog

Route::get('/shop/catalog/{shopId}', 'ProductController@shopCatalog');
Route::get('/sample', function(){
    return view('shops.shop_profile');
});

Route::get('user_home', ['middleware' => 'auth', function()
{
    return view('userdash.user_home');
}]);

Route::get('/cart/destroy/{itemId}', 'CartController@destroy')->name('cart.destroy')->middleware('auth');


// otp blah blah
// include otp email here
// sendmail route
Route::get('/otp_validation_payment_reg/{order_num}', 'otpAgricoinsController@index')->middleware('auth');
// Route::get('/otp_coins_ver_status/{order_num}/{otp_pin}', 'otpAgricoinsController@validate')->middleware('auth');
// otp agricoins confirmation 

Route::get('/otp_validation_view/{order_num}', 'otpAgricoinsController@otpAgriCoinsConfirmView')->middleware('auth');
// otp validation confirmation
Route::post('/otp_validation_confirmation', 'otpAgricoinsController@otpAgriCoinsConfirm')->middleware('auth');


Route::get('/confirm_otp/{confirm_otp}/{order_num}', 'otpAgricoinsController@confirmViaButton')->middleware('auth');

Route::get('/my_orders/delivery', function(){
    return view('user_orders.delivery.index_parent');
});


Route::get('user_orders', ['middleware' => 'auth', function()
{
    return view('userdash.user_orders_page')->with('order_disp_type', 'all');
}]);

Route::get('user_orders_pending', ['middleware' => 'auth', function()
{
    return view('userdash.user_orders_page')->with('order_disp_type', 'pending');
}]);

Route::get('user_orders_completed', ['middleware' => 'auth', function()
{
    return view('userdash.user_orders_page')->with('order_disp_type', 'completed');
}]);

// coins top up
Route::get('user_coins_top_up', ['middleware' => 'auth', function()
{
    return view('userdash.coins_top_up');
}]);

Route::post('user_coins_top_up_conf', 'coinsTopUp@submitTopUp');

// notifications
Route::get('/notifications', 'notifController@index')->middleware('auth');

Route::post('submit_coins_invalid', 'coinsTopUp@invalidCoinsTopUp');

// for coins emp
Route::post('coins_top_up', 'coinsTopUp@invalidCoinsTopUp')->name('coins_invalid_init');


// Route::group(['prefix' => 'admin'], function () {
//     Route::get('/order/pay/{suborder}', 'SubOrderController@pay')->name('order.pay');
// });


Route::group(['prefix' => 'seller', 'middleware' => 'auth', 'as' => 'seller.', 'namespace' => 'Seller'], function () {

    Route::redirect('/','seller/orders');

    Route::resource('/orders',  'OrderController');

    Route::get('/orders/delivered/{suborder}',  'OrderController@markDelivered')->name('order.delivered');
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/optimizeclear', function () {
    Artisan::call('optimize:clear');
});

Route::get('/seller_center', function () {
    return view('layouts.sellerRegistration');
});
Route::get('/registration_fee_instructions', function(){
    return view('layouts.payRegistrationFee');
});

Route::get('/my_orders_raw', function(){
    return view('user_orders.pickup.index_raw');
});

Route::post('sellRegsubmit', 'sellRegController@save_new_vendor')->name('sellRegsubmit');
Route::post('confirm_registration_fee', 'sellRegController@confirm_registration_fee')->name('confirm_registration_fee');
Route::get('seller_registered_redir', 'sellRegController@complete_seller_reg');

Route::get('/verify', function () {
    return view('auth.verify');
});
Route::get('/seller_Registration_status', function (){
   return view('sellers.order_conf.pending');
});

include 'admin_routes.php';
include 'test_routes.php';
include 'sellerPanel_routes.php';
include 'rider_routes.php';
include 'user_order_routes.php';
include 'coinsTopUpEmp_routes.php';
include 'cust_routes.php';
// Registration Routes...
Route::post('register', 'Auth\RegisterController@register');

Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

Route::get('/user_tos', function(){
    return view('extra_views.privacy_policy');
});

Route::get('/confirm_accepted_tos', function(){
   $db_update = DB::table('users')->where('id', Auth::id())->update(['is_accepted_user_tos' => 'yes']);
   return redirect('/verify'); 
});

Route::get('autovalidatecronjob', 'CoinsPanelController@autoValidateCronJobs');
//Route::get('/secret', function (){
//    return view('secret.allcredentials');
//});

Route::get('/order_products_monitoring_upload/{suborder_item_id}', 'OrderMgmtPanelController@addProductMonitoringLogs');
Route::get('/admin/edit_order_status/{status_id}/{order_id}', 'OrderMgmtPanelController@markOrderDeliveryStatus');

Route::get('user_pre_orders', ['middleware' => 'auth', function()
{
    return view('userdash.user_pre_sale_orders')->with('order_disp_type', 'all');
}]);

// ordermonitoring set images public routes both rider and seller
Route::post('order_products_monitoring_upload', 'OrderMgmtPanelController@addProductMonitoringLogs');

