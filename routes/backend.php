<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect(route('login.form'));
});

Route::get(getSystemPrefix(), function () {
    return redirect(route('login.form'));
});

Route::group(['namespace' => 'System', 'prefix' => getSystemPrefix(), 'middleware' => ['language']], function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login.form');
    Route::post('/login', 'Auth\LoginController@login')->name('login');

    Route::get('/register', 'Auth\RegisterController@showRegisterForm')->name('register.form');
    Route::post('/register', 'Auth\RegisterController@register')->name('register');

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

    Route::group(['middleware' => ['auth', 'permission', 'twofa', 'reset.password', '2fa']], function () {
        Route::post('/2fa', function () {
            return redirect(route('home'));
        })->name('2fa');
        Route::get('/home', 'indexController@index')->name('home');
        Route::resource('/roles', 'user\RoleController', ['except' => ['show']]);

        Route::resource('/users', 'user\UserController', ['except' => ['show']]);

        Route::resource('/ticket', 'ticket\TicketController');
        Route::resource('ticket', 'ticket\TicketController')->except('show');
        Route::middleware(['check.ticket.ownership'])->group(function () {
            Route::get('ticket/{ticket}/edit', 'ticket\TicketController@edit')->name('tickets.edit');
            Route::put('ticket/{ticket}', 'ticket\TicketController@update')->name('tickets.update');
        });
        Route::post('ticket/updateStatus/{id}', 'ticket\TicketController@updateStatus')->name('updateStatus');
        Route::post('ticket/updatePriority/{id}', 'ticket\TicketController@updatePriority')->name('updatePriority');
        Route::resource('/ticket/{id}/consult', 'ticketConsult\TicketConsultController')->middleware('check.ticket.authorization');;

        Route::get('/profile', 'profile\ProfileController@index')->name('profile');
        Route::put('/profile/{id}', 'profile\ProfileController@update');

        Route::post('users/reset-password/{id}', 'user\UserController@passwordReset')->name('user.reset-password');

    });
});
