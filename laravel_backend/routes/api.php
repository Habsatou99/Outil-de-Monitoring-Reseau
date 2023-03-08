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

Route::get('/','App\Http\Controllers\UserController@index');
Route::post('/api/login','App\Http\Controllers\Api\Auth\AuthentificationController@login');
Route::get('/api/equipements','App\Http\Controllers\EquipementController@equipement');
Route::post('/api/save','App\Http\Controllers\EquipementController@store');
Route::delete('/api/delete/{id}','App\Http\Controllers\EquipementController@destroy');

/*Route::group(['namespace'=>'Api\Auth'],function(){
  
});*/
