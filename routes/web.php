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

Route::get('/application', function () {
    return view('application');
});

Route::post('/application/create', 'ApplicationController@create');

Route::group(['prefix' => 'admin', 'middleware' => ['check.login']], function() {

    Route::get('login', 'Admin\UserController@loginPage');
    Route::post('login', 'Admin\UserController@login');

    Route::get('home', 'Admin\UserController@home');
    Route::get('setting', 'Admin\UserController@passAdmin');
    Route::post('setting', 'Admin\UserController@passUpdate');

    Route::get('record', function() { return view('admin/record/index'); });
    Route::get('record/edit', function() { return view('admin/record/edit'); });
    Route::get('grant', function() { return view('admin/grant/index'); });

    Route::get('questions', 'Admin\QuestionController@lists');
    Route::get('questions/create', 'Admin\QuestionController@createPage');
    Route::post('questions/create', 'Admin\QuestionController@create');
    Route::get('questions/edit/{id}', 'Admin\QuestionController@edit');
    Route::post('questions/edit/{id}', 'Admin\QuestionController@update');
    Route::get('questions/del/{id}', 'Admin\QuestionController@del');

    Route::get('result', 'Admin\ResultController@lists');
    Route::get('result/excelExport', 'Admin\ResultController@excelExport');
    Route::get('result/pdfExport', 'Admin\ResultController@pdfExport');
    Route::get('detail/{id}', 'Admin\ResultController@detail');

    Route::get('logout', 'Admin\UserController@logout');
});
