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
Route::get('/', 'Main\MainController@index')->name('index');
Route::get('/install', 'Main\InstallController@install')->name('install');
Route::get('/install/database', 'Main\InstallController@databaseStep')->name('install.database');
Route::post('/install/database', 'Main\InstallController@databaseUpdate')->name('settings.database.update');
Route::get('/install/informations', 'Main\InstallController@informationsStep')->name('install.informations');
Route::post('/install/informations', 'Main\InstallController@informationsUpdate')->name('settings.updateOrCreate');
Route::get('/install/admin', 'Main\InstallController@adminStep')->name('install.admin');
Route::post('/install/admin', 'Users\AdminController@store')->name('install.admin');
/** --------------------- */

Route::get('/homepage', 'Main\MainController@homepage')->name('homepage');
