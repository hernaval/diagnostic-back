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

Route::group(['prefix' => 'user' ,'middleware' => ['api']], function () {

    // header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
    // header('Access-Control-Allow-Headers: Content-Type, Authorizations');
    
    
    
    Route::post("signup","UserController@register");
    Route::post("login","UserController@login");
    Route::post("resend","UserController@resend");
    
    Route::put("confirmation","UserController@confirm");

    Route::post("dimension","DimensionController@create");
    Route::get("dimension","DimensionController@show");
    Route::delete("dimension","DimensionController@destroy");


    // api for user information
    Route::get("","Users\InformationController@show");
    Route::put("","Users\InformationController@update");
    Route::delete("","Users\InformationController@destroy");
    

});

Route::group(['prefix' => 'admin'],function(){
    Route::group(['prefix' => 'user'], function () {
        Route::apiResource("","Admin\AdminUserController");
    });
});


