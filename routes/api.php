<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'frontend', 'prefix' => 'v1',  'middleware' => ['passport:frontend-api']], function () {
    Route::post('/login', 'auth\LoginController@login');
});

Route::group(['namespace' => 'Api', 'prefix' => 'v1',  'middleware' => ['lang']], function(){
    Route::post('test', 'TestController@store');
    Route::get('categories', 'Categories\CategoriesController@index');
    Route::get('category-detail/{id}', 'Categories\CategoriesController@detail');
});

