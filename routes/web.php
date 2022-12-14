<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::fallback(function () {
    return view('about', ["message" => "404 Not Found"]);
});

/*
| Website routes v1 - No controllers needed.
|
| @route  /home
| @route  /plant
| @route  /plant/create
| @route  /plant/{id}
*/
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/plant', function () {
        return view('plant.index');
    })->name('plant.index');

    Route::get('/plant/create', function () {
        return view('plant.create');
    })->name('plant.create');

    Route::get('/plant/{id}', function ($id) {
        return view('plant.show', ['plant_id' => $id]);
    })->name('plant.show');
});
