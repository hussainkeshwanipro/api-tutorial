<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('first', [ApiController::class, 'index']);

Route::get('getapi', [ApiController::class, 'getapi']);
Route::post('postapi', [ApiController::class, 'postapi']);

//single image upload
Route::post('singleimage', [ApiController::class, 'singleimage']);

//multiple image upload
Route::post('multipleimage', [ApiController::class, 'multipleimage']);

//login registered
Route::post('login', [ApiController::class, 'login']);