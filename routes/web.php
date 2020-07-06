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
Route::get('/cart', 'NavigationController@showCart')->name('cart');
Route::get('/category/{category:code}', 'CategoryController@show')->name('category.show');
Route::get('/product/{product:code}', 'ProductController@show')->name('product.show');