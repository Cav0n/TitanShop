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

Route::get('/', 'Main\MainController@index')->name('index');
Route::get('/install', 'Main\MainController@install')->name('install');
Route::post('/install/database', 'Main\SettingsController@databaseUpdate')->name('settings.database.update');
