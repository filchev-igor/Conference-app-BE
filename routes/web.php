<?php

use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/conferences', [ConferenceController::class, 'index']);
Route::post('/conferences', [ConferenceController::class, 'store']);
Route::get('/conferences/{id}', [ConferenceController::class, 'show']);
Route::put('/conferences/{id}', [ConferenceController::class, 'update']);  // Use PUT instead of PATCH
Route::delete('/conferences/{id}', [ConferenceController::class, 'destroy']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);  // Add this route for user details
Route::put('/users/{id}', [UserController::class, 'update']);  // Use PUT instead of PATCH

