<?php

//admin模块组
Route::group('admin', function () {
    Route::post('login', 'login/login')->name('admin.login');
    Route::post('yoga', 'login/addYoga')->name('admin.yoga');


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

            Route::get('getSpannerList', 'system/getSpannerList')->name('auth.system.getSpannerList')->middleware('paginate');

            Route::post('addSpannerInfo', 'system/addSpannerInfo')->name('auth.system.addSpannerInfo');

            Route::post('editSpannerInfo', 'system/editSpannerInfo')->name('auth.system.editSpannerInfo');

            Route::post('setIndexLanguage', 'system/setIndexLanguage')->name('auth.system.setIndexLanguage');

            Route::get('getIndexLanguage', 'system/getIndexLanguage')->name('auth.system.getIndexLanguage');

            Route::get('getImageCacheType', 'system/getImageCacheType');

            Route::post('clearImageCache', 'system/clearImageCache');
        });

    })->middleware('auth');

    //测试组
    Route::group('test', function () {
        Route::get('index', 'test/index')->name('admin.test.index');

        Route::post('setAdminUser', 'test/setAdminUser')->name('admin.test.setAdminUser');
    });
})->prefix('@admin/')->middleware('validation');

Route::miss('index');
