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
Route::get('/customers', 'CustomerController@index');
Route::get('/customers/{id}', 'CustomerController@show')->where('id', '[0-9]+');
Route::delete('/customers/{id}', 'CustomerController@delete')->where('id', '[0-9]+');
Route::patch('/customers/{id}', 'CustomerController@update')->where('id', '[0-9]+');
Route::post('/customers', 'CustomerController@create');
