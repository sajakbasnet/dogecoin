<?php
Route::post('/oauth/token', [
  'uses' => 'Api\auth\customAccessTokenController@issueUserToken'
])->middleware('throttle', 'lang');