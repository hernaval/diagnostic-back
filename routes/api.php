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

    Route::post("forgot","UserController@forgotPassword");
    Route::get("forgot","UserController@validateToken");
    Route::put("forgot","UserController@resetPassword");

    Route::post("dimension","DimensionController@create");
    Route::get("dimension","DimensionController@show");
    Route::delete("dimension","DimensionController@destroy");

    Route::post("restitution","RestitutionController@create");
    Route::get("restitution","RestitutionController@last");
    Route::delete("restitution","RestitutionController@destroy");


    // api for user information
    Route::get("","Users\InformationController@show");
    Route::put("","Users\InformationController@update");
    Route::delete("","Users\InformationController@destroy");
    Route::put("password","Users\InformationController@changePassword");
    Route::post("avatar","Users\InformationController@changeAvatar");


    //api for contact
    Route::post("contact","Support\ContactController@send");

    //api for article
    Route::post("article","Users\ArticleController@save");
    Route::get("article","Users\ArticleController@show");
    Route::delete("article/{id}","Users\ArticleController@save");
    

});

Route::group(['prefix' => 'admin'],function(){

    Route::group(['prefix' => "questionnaire"], function(){
        Route::post("","Admin\QuestionnaireController@store");
        Route::put("/{id}","Admin\QuestionnaireController@update");
        Route::get("","Admin\QuestionnaireController@index");
        Route::get("/{id}","Admin\QuestionnaireController@show");
        Route::delete("/{id}","Admin\QuestionnaireController@destroy");
    });
//
    Route::group(['prefix' => "dimension"], function(){
        Route::post("","Admin\DimensionController@store");
        Route::put("/{id}","Admin\DimensionController@update");
        Route::get("","Admin\DimensionController@index");
        Route::get("/{id}","Admin\DimensionController@show");
        Route::delete("/{id}","Admin\DimensionController@destroy");
    });

    Route::group(['prefix' => "mesure"], function(){
        Route::post("","Admin\MesureController@store");
        Route::put("/{id}","Admin\MesureController@update");
        Route::get("","Admin\MesureController@index");
        Route::get("/{id}","Admin\MesureController@show");
        Route::delete("/{id}","Admin\MesureController@destroy");
    });

    Route::group(['prefix' => 'user'], function () {
       // Route::apiResource("","Admin\AdminUserController");
        Route::get("/{id}/activity","Admin\ActiviteController@indexUser");
        Route::delete("/activity","Admin\ActiviteController@destroy");

        Route::get("/{id}","Admin\AdminUserController@show");
        Route::get("","Admin\AdminUserController@index");

    });

    Route::group(['prefix' => 'statistiques'], function () {
        Route::get("restitution","Admin\StatistiqueController@statByDimension");
    });

    Route::group(['prefix' => 'article'], function () {
        Route::post("","Admin\ArticleController@store");
        Route::get("","Admin\ArticleController@index");
        Route::delete("/{id}","Admin\ArticleController@index");
    });
});


