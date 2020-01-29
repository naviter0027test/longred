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
    return redirect('/admin/login');
});

Route::group(['middleware' => ['check.account']], function() {

    Route::get('/application', function () {
        return view('application');
    });
    Route::post('/application/create', 'ApplicationController@create');
    Route::get('/application/create', function () {
        return view('application');
    });

    Route::group(['prefix' => 'account'], function() {
        Route::get('login', 'AccountController@loginPage');
        Route::post('login', 'AccountController@login');
        Route::get('logout', 'AccountController@logout');
        Route::get('get', 'AccountController@getMyData');
    });
});
Route::group(['prefix' => 'account'], function() {
    Route::get('isLogin', 'AccountController@isLogin');
});

Route::group(['prefix' => 'telegram'], function() {
    Route::any('test', 'TelegramController@test');
    Route::get('login', 'TelegramController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['check.login']], function() {

    Route::get('login', 'Admin\UserController@loginPage');
    Route::post('login', 'Admin\UserController@login');

    Route::get('home', 'Admin\UserController@home');
    Route::get('setting', 'Admin\UserController@passAdmin');
    Route::post('setting', 'Admin\UserController@passUpdate');

    Route::get('record', 'Admin\RecordController@index');
    Route::get('record/edit/{id}', 'Admin\RecordController@edit');
    Route::post('record/edit/{id}', 'Admin\RecordController@update');
    Route::post('record/import', 'Admin\RecordController@import');
    Route::get('record/remove/{id}', 'Admin\RecordController@remove');
    Route::get('grant', 'Admin\RecordController@grant');

    Route::get( 'account', 'Admin\AccountController@lists');
    Route::get( 'account/create', 'Admin\AccountController@createPage');
    Route::post('account/create', 'Admin\AccountController@create');
    Route::get( 'account/edit/{id}', 'Admin\AccountController@edit');
    Route::post('account/edit/{id}', 'Admin\AccountController@update');
    Route::get( 'account/remove/{id}', 'Admin\AccountController@remove');

    Route::get('result', 'Admin\ResultController@lists');
    Route::get('result/excelExport', 'Admin\ResultController@excelExport');
    Route::get('result/pdfExport', 'Admin\ResultController@pdfExport');
    Route::get('detail/{id}', 'Admin\ResultController@detail');

    Route::get('logout', 'Admin\UserController@logout');
});
