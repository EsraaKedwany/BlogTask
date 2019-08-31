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

Route::post('/tweets','API\TweetController@store');
Route::delete('/tweets/{tweet}','API\TweetController@destroy');

Route::post('/register', 'API\RegisterController@register');
Route::post('/login', 'API\LoginController@login');
Route::get('/searchbyname/{name}', 'API\UserController@searchByName');
Route::get('/searchbyemail/{email}', 'API\UserController@searchByEmail');

Route::post('/follow/{user}', 'API\UserController@follow');

