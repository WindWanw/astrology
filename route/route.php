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
    Route::get('index', 'index/index')->name('index');

    Route::group('login', function () {

        Route::post('login', 'login/login')->name('index.login.login');

        Route::post('register', 'login/register')->name('index.login.register');

        Route::get('logout', 'login/logout')->name('index.login.logout');
    });

    Route::group('blog', function () {

        Route::get('list', 'blog/getBlogList')->name('index.blog.list');

        Route::get('details', 'blog/getBlogDetails')->name('index.blog.details');
    });

    Route::group('about', function () {

        Route::get('index', 'about/index')->name('index.about.index');
    });
})->prefix('index/');

Route::miss('index');
