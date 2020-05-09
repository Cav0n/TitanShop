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
    Route::get('/order/tracking', 'Orders\OrderController@tracking')->name('order.tracking');
    Route::get('/contact', 'Main\ContactController@show')->name('contact.show');
    Route::post('/contact', 'Main\ContactController@sendMessage')->name('contact.sendMessage');

    /**
     * CART
     */
    Route::group(['prefix' => 'cart'], function () {
        Route::get('', 'Cart\CartStepController@showCurrent')->name('cart');

        Route::get('items/add', 'Cart\CartItemController@store')->name('cart.items.add');
        Route::get('item/added/{item}', 'Cart\CartItemController@notificationPage')->name('cart.item.added');
        Route::get('delivery', 'Cart\CartStepController@showDelivery')->name('cart.delivery');
        Route::post('delivery/add-addresses', 'Cart\CartController@addAddresses')->name('cart.delivery.add-addresses');
        Route::get('payment', 'Cart\CartStepController@showPayment')->name('cart.payment');
        Route::post('payment', 'Cart\CartController@doPayment')->name('cart.payment.post');
        Route::get('payment/cheque', 'Cart\CartController@chequeInstructions')->name('cart.payment.cheque');
        Route::get('create-order', 'Cart\CartController@createOrder')->name('cart.create-order');
        Route::get('thanks/{order:trackingNumber}', 'Cart\CartStepController@showThanks')->name('cart.thanks');
    });
     /** --------------------- */

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
            Route::post('order/{order}/update-status', 'Orders\OrderController@updateStatus')->name('admin.order.updateStatus');

            Route::get('products', 'Products\ProductBaseController@index')->name('admin.products');
            Route::get('categories', 'Categories\CategoryBaseController@index')->name('admin.categories');
            Route::get('orders', 'Orders\OrderController@index')->name('admin.orders');
            Route::get('users/customers', 'Users\UserController@index')->name('admin.users.customers');
            Route::get('users/administrators', 'Users\AdminController@index')->name('admin.users.administrators');
            Route::get('settings', 'Settings\SettingController@index')->name('admin.settings');

            Route::get('order/new', 'Orders\OrderController@create')->name('admin.order.create');
            Route::post('order/new', 'Orders\OrderController@store')->name('admin.order.store');
            Route::get('order/{order}', 'Orders\OrderController@edit')->name('admin.order.edit');
            Route::post('order/{order}', 'Orders\OrderController@update')->name('admin.order.update');

            Route::get('product/new', 'Products\ProductBaseController@create')->name('admin.product.create');
            Route::post('product/new', 'Products\ProductBaseController@store')->name('admin.product.store');
            Route::get('product/{product}', 'Products\ProductBaseController@edit')->name('admin.product.edit');
            Route::post('product/{product}', 'Products\ProductBaseController@update')->name('admin.product.update');
            Route::post('product/{product}/images/add', 'Products\ProductBaseController@addImage')->name('admin.product.images.add');
            Route::delete('product/{product}/images/{image}/delete', 'Products\ProductBaseController@deleteImage')->name('admin.product.images.delete');

            Route::get('category/new', 'Categories\CategoryBaseController@create')->name('admin.category.create');
            Route::post('category/new', 'Categories\CategoryBaseController@store')->name('admin.category.store');
            Route::get('category/{categoryBase}', 'Categories\CategoryBaseController@edit')->name('admin.category.edit');
            Route::post('category/{categoryBase}', 'Categories\CategoryBaseController@update')->name('admin.category.update');

            Route::get('users/customer/new', 'Users\UserController@create')->name('admin.users.customer.create');
            Route::post('users/customer/new', 'Users\UserController@store')->name('admin.users.customer.store');
            Route::get('users/customer/{customer}', 'Users\UserController@edit')->name('admin.users.customer.edit');
            Route::post('users/customer/{customer}', 'Users\UserController@update')->name('admin.users.customer.update');

            Route::get('users/administrator/new', 'Users\AdminController@create')->name('admin.users.administrator.create');
            Route::post('users/administrator/new', 'Users\AdminController@store')->name('admin.users.administrator.store');
            Route::get('users/administrator/{administrator}', 'Users\AdminController@edit')->name('admin.users.administrator.edit');
            Route::post('users/administrator/{administrator}', 'Users\AdminController@update')->name('admin.users.administrator.update');

            Route::post('settings/update', 'Settings\SettingController@updateOrCreate')->name('admin.settings.update');
        });
    });
     /** --------------------- */
});
