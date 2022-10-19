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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/plant', [App\Http\Controllers\PlantPageController::class, 'index'])->name('plant.index');
Route::get('/plant/create', [App\Http\Controllers\PlantPageController::class, 'create'])->name('plant.create');
Route::get('/plant/edit/{plant_id}', [App\Http\Controllers\PlantPageController::class, 'edit'])->name('plant.edit');
Route::get('/plant/{plant_id}', [App\Http\Controllers\PlantPageController::class, 'show'])->name('plant.show');

Route::get('/settings', [App\Http\Controllers\UserController::class, 'settings'])->name('user.settings');

Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
Route::get('/profile/edit', [App\Http\Controllers\UserController::class, 'editProfile'])->name('user.profile.edit');
