<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
//首页路由
Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'Play\LiveController@index')->name('index');
    Route::get('directory/all', 'Play\LiveController@all')->name('all');
    Route::get('directory', 'Play\LiveController@directory')->name('directory');
    Route::get('category/{uri}','Play\LiveController@category');
    Route::get('/{id}', 'Play\LiveController@getLive')->where('id', '[0-9]+');
});

//前台认证路由
Route::group(['middleware' => ['web']], function () {
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
    Route::get('logout', 'Auth\AuthController@getLogout');
});

//前台管理路由
Route::group(['middleware' => ['web'], 'prefix' => 'account'], function () {
    //用户信息
    Route::get('/', 'AccountController@getIndex')->name('account');
    Route::get('setting', 'AccountController@getSetting')->name('account_setting');
    Route::get('manage', 'AccountController@getManage')->name('account_manage');
    Route::post('cover', 'AccountController@postCover')->name('account_cover');
    //直播管理
    Route::get('live','Play\LiveManageController@getIndex')->name('live_manage');
    Route::post('live/create','Play\LiveManageController@postCreate')->name('live_create');
    Route::post('live/stop', 'Play\LiveManageController@postStop')->name('live_stop');
});

//后台认证路由
Route::group(['middleware' => ['web'], 'prefix' => 'admin'], function () {
    //注册登录
    Route::get('login', 'Admin\AuthController@getLogin');
    Route::post('login', 'Admin\AuthController@postLogin');
    Route::get('register', 'Admin\AuthController@getRegister');
    Route::post('register', 'Admin\AuthController@postRegister');
    Route::get('logout', 'Admin\AuthController@getLogout');
    //管理页面
    Route::get('/', 'AdminController@getIndex')->name('admin_index');
    Route::get('activity', 'AdminController@getActivity')->name('admin_act_info');
    Route::get('activity/info','AdminController@getActivityInfo')->name('admin_act_manage');
    Route::post('activity/info','AdminController@postStopActivity')->name('admin_act_stop');
    //用户管理
    Route::get('users/normal','AdminController@getNormalUsers')->name('admin_users_normal');
    Route::get('users/blocked','AdminController@getBlockedUsers')->name('admin_users_blocked');
    Route::post('users/block', 'AdminController@postBlockUser')->name('admin_block_user');
    Route::post('users/unblock', 'AdminController@postUnblockUser')->name('admin_unblock_user');
});

//API
Route::group(['middleware' => ['web'], 'prefix' => 'api'], function () {
    //需登录认证API
    Route::group(['middleware' => ['web'], 'prefix' => 'user'], function () {
        Route::get('getinfo', 'Api\UserController@getInfo');
        Route::get('setting/update', 'Api\UserController@getSettingUpdate');
        Route::post('setting/update', 'Api\UserController@postSettingUpdate');
        Route::get('info/update', 'Api\UserController@getInfoUpdate');
        Route::post('info/update', 'Api\UserController@postInfoUpdate');
        Route::get('live/getpushurl','Play\LiveManageController@getPushUrl');
    });
    //无需登录API
    Route::group(['middleware' => ['web']], function () {
        Route::get('live/getinfo','Api\LiveController@getLiveInfo');
    });
});