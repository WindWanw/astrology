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

    //测试组
    Route::group('test', function () {
        Route::get('index', 'test/index')->name('admin.test.index');
    })->prefixx('test/');
})->prefix('admin/')->middleware('validation');

Route::miss('index/index/index');
