<?php
Route::post('/api/v1/login', [
  'uses' => 'Api\auth\LoginController@login'
])->middleware('throttle', 'lang');
Route::post('/api/v1/refresh-token', [
  'uses' => 'Api\auth\LoginController@refreshToken'
])->middleware('throttle', 'lang');