<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Define the login route for API authentication
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Group for protected routes using Sanctum's token-based authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/conferences', [ConferenceController::class, 'index']);
    Route::post('/conferences', [ConferenceController::class, 'store']);
    Route::get('/conferences/{id}', [ConferenceController::class, 'show']);
    Route::put('/conferences/{id}', [ConferenceController::class, 'update']);
    Route::delete('/conferences/{id}', [ConferenceController::class, 'destroy']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
});
