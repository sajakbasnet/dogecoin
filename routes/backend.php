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
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['middleware' => ['auth', 'antitwofa']], function () {
        Route::get('/login/verify', 'Auth\VerificationController@showVerifyPage');
        Route::post('/login/verify', 'Auth\VerificationController@verify')->name('verify.post');
        Route::get('/login/send-again', 'Auth\VerificationController@sendAgain')->name('verify.send.again');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('change-password', 'user\UserController@changePassword')->name('change.password');
    });

    Route::group(['middleware' => ['auth', 'permission', 'twofa', 'reset.password']], function () {
        Route::get('/home', 'indexController@index')->name('home');
        Route::resource('/roles', 'user\RoleController', ['except' => ['show']]);

        Route::resource('/users', 'user\UserController', ['except' => ['show']]);

        Route::get('/profile', 'profile\ProfileController@index')->name('profile');
        Route::put('/profile/{id}', 'profile\ProfileController@update');
        
        Route::resource('/languages', 'language\LanguageController', ['except' => ['show', 'edit', 'update']]);
        Route::get('/languages/set-language/{lang}', 'language\LanguageController@setLanguage')->name('set.lang');
        Route::get('/country-language/{country_id}', 'countryLanguage\countryLanguageController@getLanguages');

        Route::resource('/translations', 'language\TranslationController', ['except' => ['show', 'edit', 'create']]);
        Route::get('/translations/download-sample', 'language\TranslationController@downloadSample');
        Route::get('/translations/download/{group}', 'language\TranslationController@downloadExcel');
        Route::post('/translations/upload/{group}', 'language\TranslationController@uploadExcel');

        Route::resource('/email-templates', 'systemConfig\emailTemplateController', ['except' => ['show']]);
        
        Route::resource('/configs', 'systemConfig\configController');

        Route::resource('/categories', 'category\categoryController');
    });
});
