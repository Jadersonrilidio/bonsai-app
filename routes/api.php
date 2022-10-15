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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//          /api/v1/

Route::prefix('/v1')->apiResource('bonsai-style', 'App\Http\Controllers\BonsaiStyleController');
Route::prefix('/v1')->apiResource('plant-classification', 'App\Http\Controllers\PlantClassificationController');
Route::prefix('/v1')->apiResource('intervention-classification', 'App\Http\Controllers\InterventionClassificationController');

Route::prefix('/v1')->apiResource('plant', 'App\Http\Controllers\PlantController');

Route::prefix('/v1')->apiResource('picture', 'App\Http\Controllers\PictureController');
Route::prefix('/v1')->apiResource('video', 'App\Http\Controllers\VideoController');

Route::prefix('/v1')->apiResource('intervention', 'App\Http\Controllers\InterventionController');

Route::prefix('/v1')->apiResource('observation', 'App\Http\Controllers\ObservationController');