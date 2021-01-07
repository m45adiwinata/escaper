<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // if (!isset($_COOKIE['guest_code'])) {
    //     return view('currency');
    // }
    // return redirect('/home');
    return view('currency');
});
Route::get('/fblogin', function() {
    return view('fblogin');
});

Route::get('/home', 'homeController@index');
Route::post('/welcome', 'homeController@welcome');
Route::get('/about', 'aboutController@index');
Route::get('/contact', 'contactController@index');
Route::post('/contact/send-comment', 'contactController@sendComment')->name('contact.comment');
Route::get('/shop', 'shopController@index');
Route::get('/lookbook', 'lookbookController@index');
Route::get('/product', 'shopController@product');
Route::get('/get-product-price/{id}/{size}', 'shopController@getPrice');
Route::get('/add-to-cart/{id}/{size}/{amount}', 'shopController@add2Cart');
Route::get('/cart-check', 'shopController@cartCheck');
Route::get('/cart', 'CartController@index');
Route::get('/cart/change-amount', 'CartController@changeAmt');
Route::get('/cart/delete-item', 'CartController@deleteItem');
Route::get('/cart/get-grand-total', 'CartController@getGrandTotal');
Route::get('/cart/checkout', 'CartController@checkout');
Route::post('/cart/place-order', 'CartController@placeOrder');
Route::get('/cart/upload-payment/{checkout_id}', 'CartController@uploadPayment');
Route::post('/cart/post-upload', 'CartController@postUpload');
Route::get('/send-email', 'ContactController@sendEmail');
Route::get('/cart/received/{id}', 'CartController@received');
Route::post('/cart/set-lunas', 'CartController@setLunas')->name('setlunas');
Route::get('/cart/check-discount/{email}', 'CartController@checkDiscount');
Route::post('/subscriber/store', 'SubscriberController@store')->name('subscriber.store');
Route::get('/submitpayment/{checkout_id}', 'CartController@submitPayment');
Route::post('/cart/update-temp-cart', 'CartController@updateTempCart');
Route::get('/cart/check-stock-item/{product_id}/{size_init}', 'CartController@checkStockItem');
Route::post('/cart/checkout/login', 'CartController@checkoutLogin');
Route::get('/construction', function () {
    return view('construction');
});
Route::get('/stockist', 'HomeController@stockist');
Route::get('/shipping', 'HomeController@shipping');
