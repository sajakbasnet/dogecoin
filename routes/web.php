<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
define("PREFIX", Config::get('constants.PREFIX'));
define("PAGINATE", Config::get('constants.PAGINATE'));
include('backend.php');
include('frontend.php');


