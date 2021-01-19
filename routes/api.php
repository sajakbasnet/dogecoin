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

Route::group(['namespace' => 'Api', 'prefix' => 'v1',  'middleware' => ['lang', 'auth-frontend']], function () {
    Route::get('categories', 'Categories\CategoriesController@index');
    Route::get('categories/{id}', 'Categories\CategoriesController@detail');
    Route::post('categories', 'Categories\CategoriesController@create');
    Route::put('categories/{id}', 'Categories\CategoriesController@update');
    Route::delete('categories/{id}', 'Categories\CategoriesController@delete');
});
