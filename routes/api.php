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

Route::post('get-all-active', 'Controller@getAllActive');

Route::get('categories-get', 'CategoryController@get');
Route::post('categories-store', 'CategoryController@store');
Route::post('categories-delete', 'CategoryController@destroy');

Route::get('blogs-get', 'BlogController@get');
Route::post('blogs-store', 'BlogController@store');
