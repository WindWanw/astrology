<?php

//admin模块组
Route::group('_index', function () {

    Route::post('login','login/login');
    //用户权限组
    Route::group('auth', function () {

       

    })->middleware('auth');


})->prefix('@api/')->middleware('validation');

Route::miss('index');
