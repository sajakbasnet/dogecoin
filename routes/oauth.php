<?php
Route::post('/api/v1/login', [
  'uses' => 'Api\auth\LoginController@login'
])->middleware('throttle', 'lang');