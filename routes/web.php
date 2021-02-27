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

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::get('u/{token}', 'UsersController@autoLogin')->name('users.autoLogin');;

Route::group(['middleware' => ['auth']], function () {
        Route::resource('items', 'ItemsController',['except' => ['show']]);
        Route::resource('categories', 'CategoriesController',['except' => ['show']]);
        Route::resource('shops', 'ShopsController',['except' => ['show']]);
        
        //買い出しリスト
        Route::get('lists', 'ListsController@index')->name('lists.index');
        Route::put('lists', 'ListsController@update')->name('lists.update');
    });

//検索結果を表示する
Route::get('items/serch','ItemsController@serch')->name('items.serch');

//買い出しリストの絞り込み機能
Route::get('lists/filter','ListsController@filter')->name('lists.filter');

//GoogleMapを表示するルート
Route::get('shops/{id}/gmap', 'ShopsController@gmap')->name('gmap');

//在庫状況をチェックするルート
Route::put('items/{id}/{status}', 'ItemStatusController@update')->name('items.status.update');

