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

/*
| Website routes v1 - No controllers needed.
|
| @route  /home
| @route  /plant
| @route  /plant/create
| @route  /plant/edit/{id}
| @route  /plant/{id}
| @route  /profile
| @route  /profile/edit
| @route  /settings
*/
Route::middleware('auth')->group(function ($router) {

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

    Route::get('/plant/edit/{id}', function ($id) {
        return view('plant.edit', ['plant_id' => $id]);
    })->name('plant.edit');

    Route::get('/profile', function () {
        return view('user.profile');
    })->name('user.profile');

    Route::get('/profile/edit', function () {
        return view('user.profile-edit');
    })->name('user.profile.edit');

    Route::get('/settings', function () {
        return view('user.settings');
    })->name('user.settings');
});
