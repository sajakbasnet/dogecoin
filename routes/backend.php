<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/' . PREFIX . '/login');
});
Route::get(PREFIX, function () {
    return redirect('/' . PREFIX . '/login');
});
Route::group(['namespace' => 'system', 'prefix' => PREFIX, 'middleware' => ['language']], function () {

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

    Route::group(['middleware' => ['auth', 'antitwofa']], function () {
        Route::get('/login/verify', 'Auth\LoginController@showVerifyPage');
        Route::post('/login/verify', 'Auth\LoginController@verify')->name('post.login.verify');
        Route::get('/login/send-again', 'Auth\LoginController@sendAgain')->name('login.send.again');
    });

    Route::group(['middleware' => ['auth', 'permission', 'twofa']], function () {
        Route::get('/home', 'indexController@index')->name('home');
        Route::resource('/roles', 'user\RoleController', ['except' => ['show']]);
        Route::resource('/users', 'user\UserController', ['except' => ['show']]);
        Route::resource('/languages', 'language\LanguageController', ['except' => ['show', 'edit', 'update']]);
        Route::resource('/email-templates', 'systemConfig\emailTemplateController', ['except' => ['show']]);
        Route::resource('/configs', 'systemConfig\configController', ['except' => ['show']]);
    });
});
