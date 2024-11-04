<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/conferences', [ConferenceController::class, 'index']);
    Route::post('/conferences', [ConferenceController::class, 'store']);
    Route::get('/conferences/{id}', [ConferenceController::class, 'show']);
    Route::put('/conferences/{id}', [ConferenceController::class, 'update']);
    Route::delete('/conferences/{id}', [ConferenceController::class, 'destroy']);

    Route::get('/users', [UserController::class, 'index']); // Get all users
    Route::get('/users/{id}', [UserController::class, 'show']); // Get user by ID
    Route::post('/users', [UserController::class, 'store']); // Create a new user
    Route::put('/users/{id}', [UserController::class, 'update']); // Update user by ID
});
