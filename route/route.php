<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//index模块组
Route::group('index', function () {
    Route::get('index/index', 'index/index')->name('index');
})->prefix('index/');

//admin模块组
Route::group('admin', function () {
    Route::post('login', 'login/login')->name('admin.login');

    //公共组
    Route::group('common', function () {
    });

    //用户权限组
    Route::group('auth', function () {

        Route::get('home/getUserInfo', 'home/getUserInfo')->name('auth.home.getUserInfo');
    })->middleware('auth');

    //测试组
    Route::group('test', function () {
        Route::get('index', 'test/index')->name('admin.test.index');

        Route::post('setAdminUser','test/setAdminUser')->name('admin.test.setAdminUser');
    });
})->prefix('@admin/')->middleware('validation');
