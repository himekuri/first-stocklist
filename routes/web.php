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

Route::get('/', 'ItemsController@index');
Route::resource('items', 'ItemsController');
Route::resource('categories', 'CategoriesController',['only' => ['index', 'create', 'edit','update', 'store', 'destroy']]);
Route::resource('shops', 'ShopsController',['only' => ['index', 'create', 'edit', 'update','store', 'destroy']]);
Route::resource('items', 'ItemsController',['only' => ['index', 'create', 'edit','update', 'store', 'destroy']]);

//GoogleMapを表示するルート
Route::get('shops/{id}/gmap', 'ShopsController@gmap')->name('gmap');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');