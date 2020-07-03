<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/' . PREFIX . '/login');
});
Route::get(PREFIX, function () {
    return redirect('/' . PREFIX . '/login');
});
Route::group(['namespace' => 'system', 'prefix' => PREFIX], function () {

    Route::get('/login', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::get('forgot-password', 'Auth\ForgotPasswordController@showRequestForm')->name('forgot.password');
    Route::post('forgot-password', 'Auth\ForgotPasswordController@handleForgotPassword')->name('post.forgot.password');
    Route::get('/reset-password/{email}/{token}', 'Auth\ResetPasswordController@showSetResetForm')->name('reset.password');
    Route::post('/reset-password', 'Auth\ResetPasswordController@handleSetResetPassword');
    Route::get('/set-password/{email}/{token}', 'Auth\ResetPasswordController@showSetResetForm')->name('set.password');
    Route::post('/set-password', 'Auth\ResetPasswordController@handleSetResetPassword');
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['middleware' => ['auth', 'permission']], function () {
        Route::get('/home', 'indexController@index')->name('home');
        Route::resource('/roles', 'user\RoleController', ['except' => ['show']]);
        Route::resource('/users', 'user\UserController', ['except' => ['show']]);
        Route::resource('/configs', 'systemConfig\configController', ['except' => ['show']]);
    });
});
