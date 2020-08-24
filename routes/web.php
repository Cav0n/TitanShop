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
Route::get('/cart/delivery', 'CartController@showDelivery')->name('cart.delivery.show');
Route::post('/cart/delivery', 'CartController@addDelivery')->name('cart.delivery.add');
Route::get('/cart/payment', 'CartController@showPayment')->name('cart.payment.show');
Route::post('/cart/payment', 'CartController@handlePayment')->name('cart.payment.handle');
Route::get('/cart/thanks', 'CartController@showThanks')->name('cart.thanks');
Route::get('/order/create-from-cart', 'OrderController@createFromCart')->name('order.create-from-cart');
Route::get('/category/{category:code}', 'CategoryController@show')->name('category.show');
Route::get('/product/{product:code}', 'ProductController@show')->name('product.show');

Route::get('/order/tracking', 'NavigationController@showOrderTrackingPage')->name('order.tracking.show');
Route::post('/order/tracking', 'OrderController@track')->name('order.tracking.handle');

Route::name('customer-area.')->prefix('customer-area')->group(function () {
    Route::middleware('isCustomerNotConnected')->group(function () {
        Route::get('/login', 'AuthController@showCustomerLoginPage')->name('login.show');
        Route::post('/login', 'AuthController@customerLogin')->name('login.handle');
        Route::get('/register', 'AuthController@showCustomerRegisterPage')->name('register.show');
        Route::post('/register', 'AuthController@customerRegister')->name('register.handle');
    });

    Route::middleware('isCustomerConnected')->group(function () {
        Route::get('/', 'NavigationController@showCustomerAreaHomepage')->name('homepage');
        Route::any('/logout', 'AuthController@customerLogout')->name('logout');

        Route::post('/informations/update', 'CustomerController@update')->name('informations.update');
        Route::get('/password/edit', 'CustomerController@editPassword')->name('password.edit');
        Route::post('/password/update', 'CustomerController@updatePassword')->name('password.update');
        Route::get('/orders', 'NavigationController@showCustomerOrders')->name('orders');
    });
});


Route::name('admin.')->prefix('admin')->group(function () {

    // Routes only for guests
    Route::middleware('isNotAdmin')->group(function () {
        Route::get('/login', 'AuthController@showAdminLoginPage')->name('login.show');
        Route::post('/login', 'AuthController@adminLogin')->name('login.handle');
    });

    // Routes only for admins
    Route::middleware('isAdmin')->group(function () {
        Route::get('/', 'NavigationController@showBackofficeHomepage')->name('homepage');
        Route::any('/logout', 'AuthController@adminLogout')->name('logout');

        Route::post('/images/upload', 'ImageController@store')->name('images.upload');

        Route::get('/catalog/{category?}', 'CategoryController@index')->name('catalog');

        Route::get('/product/create', 'ProductController@create')->name('product.create');
        Route::post('/product/create', 'ProductController@store')->name('product.store');
        Route::get('/product/edit/{product}', 'ProductController@edit')->name('product.edit');
        Route::post('/product/edit/{product}', 'ProductController@update')->name('product.update');
        Route::delete('/product/delete', 'ProductController@destroy')->name('product.delete');

        Route::get('/category/create', 'CategoryController@create')->name('category.create');
        Route::post('/category/create', 'CategoryController@store')->name('category.store');
        Route::get('/category/edit/{category}', 'CategoryController@edit')->name('category.edit');
        Route::post('/category/edit/{category}', 'CategoryController@update')->name('category.update');
        Route::delete('/category/delete', 'CategoryController@destroy')->name('category.delete');

        Route::post('/toggle-visibility/product', 'ProductController@toggleVisibility')->name('toggle-visibility.product');
        Route::post('/toggle-visibility/category', 'CategoryController@toggleVisibility')->name('toggle-visibility.category');

        Route::get('/orders/{status?}', 'OrderController@index')->name('orders');
        Route::get('/order/{order}', 'OrderController@show')->name('order.show');
        Route::patch('/order/{order}/status/update', 'OrderController@updateStatus')->name('order.status.update');

        Route::get('/customers', 'CustomerController@index')->name('customers');
        Route::get('/customer/{customer}', 'CustomerController@show')->name('customer.show');

        Route::get('/administrators', 'AdministratorController@index')->name('administrators');
        Route::get('/administrator/create', 'AdministratorController@create')->name('administrator.create');
        Route::post('/administrator/create', 'AdministratorController@store')->name('administrator.store');
        Route::get('/administrator/edit/{administrator}', 'AdministratorController@edit')->name('administrator.edit');
        Route::post('/administrator/edit/{administrator}', 'AdministratorController@update')->name('administrator.update');

        Route::get('/settings', 'SettingGroupController@index')->name('settings');
        Route::post('/settings/update', 'SettingController@updateAll')->name('settings.update');
    });
});
