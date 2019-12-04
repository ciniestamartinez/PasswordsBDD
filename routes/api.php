<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', 'UserController');
Route::apiResource('categories', 'CategoryController');
Route::apiResource('passwords', 'PasswordController');

Route::post('login', 'UserController@login');


