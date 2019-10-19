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

Route::group([
    'prefix' => 'auth'
], function () {
  Route::post('login', 'AuthController@login');
  Route::post('registration', 'AuthController@registration');
  Route::post('logout', 'AuthController@logout');
  Route::post('refresh', 'AuthController@refresh');
  Route::get('me', 'AuthController@me');
});

// Password
Route::post('password/store', 'PasswordController@store');
Route::get('password', 'PasswordController@index');
Route::put('password/update/{id}', 'PasswordController@update');
Route::delete('password/delete/{id}', 'PasswordController@destroy');

// Posts
Route::post('post/store', 'PostController@store');
Route::get('post', 'PostController@index');
Route::put('post/update/{id}', 'PostController@update');
Route::delete('post/delete/{id}', 'PostController@destroy');

// Tasks
Route::post('task/store', 'TaskController@store');
Route::get('task', 'TaskController@index');
Route::put('task/update/{id}', 'TaskController@update');
Route::delete('task/delete/{id}', 'TaskController@destroy');

// Log
Route::get('log/passwords', 'LogController@passwords');
Route::get('log/posts', 'LogController@posts');
Route::get('log/tasks', 'LogController@tasks');
