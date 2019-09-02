<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'],
 'middleware' => 'setlocale'], function() {

    Route::group(['middleware' => ['jwt.auth']], function () {

    // tweets routes
    Route::post('/tweets','API\TweetController@store');
    Route::delete('/tweets/{tweet}','API\TweetController@destroy');
    Route::get('/timeline','API\TweetController@user_time_line');

    //search/follow routes
    Route::get('/searchbyname/{name}', 'API\UserController@searchByName');
    Route::get('/searchbyemail/{email}', 'API\UserController@searchByEmail');
    Route::post('/follow/{user}', 'API\UserController@follow');

    });

    //user routes
    Route::post('/register', 'API\RegisterController@register');
    Route::post('/login', 'API\LoginController@login');


});