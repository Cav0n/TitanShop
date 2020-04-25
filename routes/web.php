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

/**
 * INSTALLATION ROUTES
 */
Route::middleware('shopIsNotInstalled')->group(function() {
    Route::get('/install', 'Main\InstallController@index')->name('install');
    Route::get('/install/database', 'Main\InstallController@databaseStep')->name('install.database');
    Route::post('/install/database', 'Main\InstallController@databaseUpdate')->name('settings.database.update');
    Route::get('/install/informations', 'Main\InstallController@informationsStep')->name('install.informations');
    Route::post('/install/informations', 'Main\InstallController@informationsUpdate')->name('settings.updateOrCreate');
    Route::get('/install/admin', 'Main\InstallController@adminStep')->name('install.admin');
    Route::post('/install/admin', 'Users\AdminController@store')->name('install.admin.post');
    Route::get('/install/success', 'Main\InstallController@success')->name('install.success');
});
/** --------------------- */


Route::middleware('shopIsInstalled')->group(function() {
    Route::get('/', 'Main\MainController@index')->name('index');
    Route::get('/product/{product}', 'Products\ProductBaseController@show')->name('product.show');
    Route::get('/category/{category}', 'Categories\CategoryBaseController@show')->name('category.show');
    Route::get('/cart/items/add', 'Cart\CartItemController@store')->name('cart.items.add');
    Route::get('/cart/item/added/{item}', 'Cart\CartItemController@notificationPage')->name('cart.item.added');
    Route::get('/cart', 'Cart\CartStepController@showCurrent')->name('cart');
    Route::get('/cart/delivery', 'Cart\CartStepController@showDelivery')->name('cart.delivery');
    Route::post('/cart/delivery/add-addresses', 'Cart\CartController@addAddresses')->name('cart.delivery.add-addresses');
    Route::get('/cart/payment', 'Cart\CartStepController@showPayment')->name('cart.payment');
    Route::post('/cart/payment', 'Cart\CartController@doPayment')->name('cart.payment.post');
    Route::get('/cart/payment/cheque', 'Cart\CartController@chequeInstructions')->name('cart.payment.cheque');
    Route::get('/cart/create-order', 'Cart\CartController@createOrder')->name('cart.create-order');
    Route::get('/cart/thanks', 'Cart\CartStepController@showThanks')->name('cart.thanks');

    /**
     * CUSTOMER AREA
     */
    Route::group(['prefix' => 'customer-area'], function () {
        Route::middleware('guest')->group(function() {
            Route::get('login', 'Auth\LoginController@show')->name('customer-area.login');
            Route::post('login', 'Auth\LoginController@login')->name('customer-area.login.post');
            Route::get('register', 'Auth\RegisterController@show')->name('customer-area.register');
            Route::post('register', 'Auth\RegisterController@register')->name('customer-area.register.post');
        });

        Route::middleware('auth')->group(function() {
            Route::get('', 'Auth\CustomerAreaController@show')->name('customer-area.index');
            Route::post('update/personal-informations', 'Users\UserController@update')->name('user.update.personal-informations.post');
            Route::post('update/password', 'Users\UserController@updatePassword')->name('user.update.password.post');

            Route::get('modal/personal-informations', 'Auth\CustomerAreaController@personalInformationsModal')->name('customer-area.modal.personal-informations');
            Route::get('modal/password', 'Auth\CustomerAreaController@passwordModal')->name('customer-area.modal.password');
            Route::any('logout', 'Auth\LoginController@logout')->name('customer-area.logout');
        });
    });
     /** --------------------- */

    /**
     * ADMIN BACKOFFICE
     */
    Route::group(['prefix' => 'admin'], function () {
        Route::middleware('notAdmin')->group(function() {
            Route::get('login', 'Admin\Auth\LoginController@showLoginPage')->name('admin.login');
            Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.post');
        });

        Route::middleware('admin')->group(function() {
            Route::get('', 'Admin\AdminController@index')->name('admin.index');
            Route::any('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
        });
    });
     /** --------------------- */
});
