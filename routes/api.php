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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'user' ,'middleware' => 'api'], function () {

    Route::get("","UserController@index");
    
    Route::post("signup","UserController@register");
    Route::post("login","UserController@login");
    Route::post("resend/{email}","UserController@resend");
    
    Route::get("confirmation","UserController@confirm");

    Route::post("dimension","DimensionController@create");
    Route::get("dimension","DimensionController@index");

});


Route::apiResource("test","UserController");