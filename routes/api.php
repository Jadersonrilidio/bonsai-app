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

Route::prefix('/v1')->group(function () {
    Route::apiResource('bonsai-style', 'App\Http\Controllers\BonsaiStyleController');
    Route::apiResource('plant-classification', 'App\Http\Controllers\PlantClassificationController');
    Route::apiResource('intervention-classification', 'App\Http\Controllers\InterventionClassificationController');
    Route::apiResource('plant', 'App\Http\Controllers\PlantController');
    Route::apiResource('picture', 'App\Http\Controllers\PictureController');
    Route::apiResource('video', 'App\Http\Controllers\VideoController');
    Route::apiResource('intervention', 'App\Http\Controllers\InterventionController');
    Route::apiResource('observation', 'App\Http\Controllers\ObservationController');
});

Route::prefix('/auth')->group(function () {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('me', [App\Http\Controllers\AuthController::class, 'me']);
});
