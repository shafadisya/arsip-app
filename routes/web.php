<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');

});

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArsipController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('arsips', ArsipController::class);
});


Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

use App\Http\Controllers\UserController;

// ...existing code...

Route::middleware('auth')->group(function () {
    Route::resource('arsips', ArsipController::class);
   Route::resource('users', UserController::class)->middleware('auth');
});