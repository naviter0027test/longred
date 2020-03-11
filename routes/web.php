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
    Route::post('/application/cancel', 'ApplicationController@cancel');
    Route::get('/application/cancel', 'ApplicationController@cancelPage');
    Route::post('/application/update', 'ApplicationController@update');
    Route::get('/application/update', 'ApplicationController@updatePage');

    Route::group(['prefix' => 'account'], function() {
        Route::get('login', 'AccountController@loginPage');
        Route::post('login', 'AccountController@login');
        Route::get('logout', 'AccountController@logout');
        Route::get('get', 'AccountController@getMyData');
        Route::get('apple-token/set', 'AccountController@appleTokenSetPage');
        Route::post('apple-token/set', 'AccountController@appleTokenSet');
        //Route::get('apple-token/get', 'AccountController@appleTokenGetPage');
        Route::get('apple-token/get', 'AccountController@appleTokenGet');

        Route::get('record', 'RecordController@index');
        Route::post('record', 'RecordController@get');

        Route::get('messages', 'MessageController@listsPage');
        Route::get('message', 'MessageController@listsByAccountId');
        Route::get('message/send', 'MessageController@sendPage');
        Route::post('message/send', 'MessageController@send');
        Route::get('message/record-id', 'MessageController@getByRecordIdPage');
        Route::post('message/record-id', 'MessageController@getByRecordId');
    });

    Route::get('/api/help', 'AccountController@apiHelp');
});
Route::group(['prefix' => 'account'], function() {
    Route::get('isLogin', 'AccountController@isLogin');
    Route::get('forget', 'AccountController@forgetPage');
    Route::post('forget', 'AccountController@forget');
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
    Route::get('record/edit/download/{id}', 'Admin\RecordController@downloadAllImages');
    Route::post('record/import', 'Admin\RecordController@import');
    Route::get('record/remove/{id}', 'Admin\RecordController@remove');
    Route::get('grant', 'Admin\RecordController@grant');

    Route::get( 'account', 'Admin\AccountController@lists');
    Route::get( 'account/create', 'Admin\AccountController@createPage');
    Route::post('account/create', 'Admin\AccountController@create');
    Route::get( 'account/edit/{id}', 'Admin\AccountController@edit');
    Route::post('account/edit/{id}', 'Admin\AccountController@update');
    Route::get( 'account/remove/{id}', 'Admin\AccountController@remove');

    Route::get('message/record/{id}', 'Admin\MessageController@getByRecordId');
    Route::post('message/send', 'Admin\MessageController@send');

    Route::get('news', 'Admin\MessageController@getNews');
    Route::get('news/create', 'Admin\MessageController@createNewPage');
    Route::post('news/create', 'Admin\MessageController@createNew');
    Route::get('news/edit/{id}', 'Admin\MessageController@editNewPage');
    Route::post('news/edit/{id}', 'Admin\MessageController@editNew');
    Route::get( 'news/remove/{id}', 'Admin\MessageController@removeNew');

    Route::get('announcement', 'Admin\MessageController@getAnnouncement');
    Route::get('announcement/create', 'Admin\MessageController@createAnnouncementPage');
    Route::post('announcement/create', 'Admin\MessageController@createAnnouncement');
    Route::get('announcement/edit/{id}', 'Admin\MessageController@editAnnouncementPage');
    Route::post('announcement/edit/{id}', 'Admin\MessageController@editAnnouncement');
    Route::get( 'announcement/remove/{id}', 'Admin\MessageController@removeAnnouncement');

    Route::get('logout', 'Admin\UserController@logout');
});
