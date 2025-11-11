<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BitcoinController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GreetingController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PrayerController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/bitcoin-price', [BitcoinController::class, 'getPrice']);
Route::post('/greeting', [GreetingController::class, 'respond']);
Route::get('/prayer-times', [PrayerController::class, 'getTimes']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
    Route::get('/users', [UserController::class, 'index']);
});
