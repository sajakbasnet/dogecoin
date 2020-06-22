<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('system/login');
});
Route::group(['namespace' => 'System','prefix' => Config::get('constants.PREFIX')], function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::get('forgot-password', 'Auth\ForgotPasswordController@showRequestForm')->name('forgot.password');
    Route::post('forgot-password', 'Auth\ForgotPasswordController@handleForgotPassword')->name('post.forgot.password');
    Route::get('/home', 'indexController@index')->name('home');
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
});
