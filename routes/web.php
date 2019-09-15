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

Route::get('test', 'TestController@test');

//Route::resource('dashboard', 'DashboardController')->names('items');
//Route::get('parser', 'ParserController@parser');

Route::get('chart/{id?}', 'ChartController@index')->name('index');

Route::get('/{any}', 'SpaController@index')->where('any', '.*');
