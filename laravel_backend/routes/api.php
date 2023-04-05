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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//route for user

Route::get('/','App\Http\Controllers\UserController@index');
Route::get('/api/user','App\Http\Controllers\UserController@index');
Route::post('/api/login','App\Http\Controllers\Api\Auth\AuthentificationController@login');
//route for equipement
Route::get('/api/equipements','App\Http\Controllers\EquipementController@equipements');
Route::get('/api/equipements/{id}','App\Http\Controllers\EquipementController@getEquipementById');

Route::post('/api/save','App\Http\Controllers\EquipementController@create');
Route::delete('/api/delete/{id}','App\Http\Controllers\EquipementController@destroy');
Route::put('/api/update/{id}','App\Http\Controllers\EquipementController@update');

//route for ping
Route::get('/api/ping1','App\Http\Controllers\PingController@time');
Route::get('/api/ping/{ip_adress}','App\Http\Controllers\PingController@getPing');
Route::post('/api/saveping/{ip_adress}','App\Http\Controllers\PingController@createPing');
Route::delete('/api/pingdelete/{id}','App\Http\Controllers\PingController@destroy');
Route::delete('/api/pingdeleteAll','App\Http\Controllers\PingController@destroyAll');