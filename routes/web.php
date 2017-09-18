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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/home', ['as' => 'admin.home', 'uses' => 'HomeController@index']);
    Route::get('/welcome', 'HomeController@welcome');

    Route::resource('admin_user', 'AdminUserController');
});
