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

// Route::prefix('/v1')->middleware('api')->group(function () {

//     Route::middleware('jwt')->group(function () {
//         Route::apiResource('bonsai-style', 'App\Http\Controllers\BonsaiStyleController');
//         Route::apiResource('plant-classification', 'App\Http\Controllers\PlantClassificationController');
//         Route::apiResource('intervention-classification', 'App\Http\Controllers\InterventionClassificationController');
//         Route::apiResource('plant', 'App\Http\Controllers\PlantController');
//         Route::apiResource('picture', 'App\Http\Controllers\PictureController');
//         Route::apiResource('video', 'App\Http\Controllers\VideoController');
//         Route::apiResource('intervention', 'App\Http\Controllers\InterventionController');
//         Route::apiResource('observation', 'App\Http\Controllers\ObservationController');

//         Route::prefix('/auth')->group(function () {
//             Route::post('/me', [App\Http\Controllers\BonsaiStyleController::class, 'me']);
//             Route::post('/logout', [App\Http\Controllers\BonsaiStyleController::class, 'logout']);
//         });
//     });

//     Route::prefix('/auth')->group(function () {
//         Route::post('/login', [App\Http\Controllers\BonsaiStyleController::class, 'login']);
//         Route::post('/refresh', [App\Http\Controllers\BonsaiStyleController::class, 'refresh']);
//     });
// });
