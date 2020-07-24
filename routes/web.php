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

Route::get('/', 'NavigationController@showHomepage')->name('homepage');
Route::any('/cart', 'CartController@show')->name('cart');
Route::post('/cart/customer-message/add', 'CartController@addCustomerMessage')->name('cart.customer-message.add');
Route::post('/cart/items/quantity/update', 'CartItemController@updateQuantity')->name('cart.items.quantity.update');
Route::post('/cart/add-product', 'CartItemController@store')->name('cart.items.add');
Route::get('/cart/delivery', 'CartController@showDelivery')->name('cart.delivery');
Route::post('/cart/delivery', 'CartController@addDelivery')->name('cart.delivery');
Route::get('/cart/payment', 'CartController@showPayment')->name('cart.payment');
Route::post('/cart/payment', 'CartController@handlePayment')->name('cart.payment');
Route::get('/cart/thanks', 'CartController@showThanks')->name('cart.thanks');
Route::get('/order/create-from-cart', 'OrderController@createFromCart')->name('order.create-from-cart');
Route::get('/category/{category:code}', 'CategoryController@show')->name('category.show');
Route::get('/product/{product:code}', 'ProductController@show')->name('product.show');
Route::get('/customer-area/login', 'AuthController@showCustomerLoginPage')->name('customer-area.login');

Route::name('admin.')->prefix('admin')->group(function () {

    // Routes only for guests
    Route::middleware('isNotAdmin')->group(function () {
        Route::get('/login', 'AuthController@showAdminLoginPage')->name('login');
        Route::post('/login', 'AuthController@adminLogin')->name('login');
    });

    // Routes only for admins
    Route::middleware('isAdmin')->group(function () {
        Route::get('/', 'NavigationController@showBackofficeHomepage')->name('homepage');
        Route::any('/logout', 'AuthController@adminLogout')->name('logout');
        Route::get('/catalog/{category?}', 'CategoryController@index')->name('catalog');
        Route::post('/toggle-visibility/product', 'ProductController@toggleVisibility')->name('toggle-visibility.product');
        Route::post('/toggle-visibility/category', 'CategoryController@toggleVisibility')->name('toggle-visibility.category');
        Route::get('/orders/{status?}', 'OrderController@index')->name('orders');
    });
});
