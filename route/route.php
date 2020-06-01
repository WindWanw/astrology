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

    // Route::get('blog/list','blog/getBlogList')->name('index.blog.list');

    Route::group('blog', function () {

        Route::get('list', 'blog/getBlogList')->name('index.blog.list');

        Route::get('details', 'blog/getBlogDetails')->name('index.blog.details');
    });

    Route::group('about', function () {

        Route::get('index', 'about/index')->name('index.about.index');
    });
})->prefix('index/');

//admin模块组
Route::group('admin', function () {
    Route::post('login', 'login/login')->name('admin.login');

    //公共组
    Route::group('common', function () {

        Route::post('uploadFile', 'common/uploadFile')->name('admin.common.uploadFile');
    });

    //用户权限组
    Route::group('auth', function () {

        Route::get('home/getUserInfo', 'home/getUserInfo')->name('auth.home.getUserInfo');

        Route::group('user', function () {

            Route::get('getUserList', 'user/getUserList')->name('auth.user.getUserList')->middleware('paginate');

            Route::post('addUserInfo', 'user/addUserInfo')->name('auth.user.addUserInfo');

            Route::post('editUserInfo', 'user/editUserInfo')->name('auth.user.editUserInfo');
        });

        Route::group('about', function () {

            Route::get('getAboutList', 'about/getAboutList')->name('auth.about.getAboutList')->middleware('paginate');

            Route::post('addAboutInfo', 'about/addAboutInfo')->name('auth.about.addAboutInfo');

            Route::post('editAboutInfo', 'about/editAboutInfo')->name('auth.about.editAboutInfo');

        });

        Route::group('system', function () {

            Route::get('getWordsList', 'system/getWordsList')->name('auth.system.getWordsList');

            Route::post('addWords', 'system/addWords')->name('auth.system.addWords');

            Route::post('editWords', 'system/editWords')->name('auth.system.editWords');

            Route::get('delWords', 'system/delWords')->name('auth.system.delWords');

        });

    })->middleware('auth');

    //测试组
    Route::group('test', function () {
        Route::get('index', 'test/index')->name('admin.test.index');

        Route::post('setAdminUser', 'test/setAdminUser')->name('admin.test.setAdminUser');
    });
})->prefix('@admin/')->middleware('validation');

Route::miss('index');
