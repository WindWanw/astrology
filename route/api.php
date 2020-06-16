<?php

//admin模块组
Route::group('_index', function () {

    Route::post('login', 'login/login');
    Route::get('logout', 'login/logout');
    Route::get('qrcodeLogin', 'login/getWXqrcode');
    //用户权限组
    Route::group('auth', function () {

        Route::get('getUserInfo', 'login/getUserInfo');

    })->middleware('auth');

})->prefix('@api/')->middleware('validation');


//h5页面
Route::group('h5', function () {

    Route::get('login', 'h5/login');
})->prefix('api/');

Route::miss('index');
