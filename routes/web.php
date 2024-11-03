<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/${id}', function () {
    //role
    //theme
    //conferences
});

Route::patch('/users/${id}', function () {
    //role
    //theme
});

Route::get('/users', function () {
    //data for the list of users
});


Route::get('/conferences', function () {
    //data for the list of conferences
});

Route::post('/conferences', function () {
    //add new conference
});

Route::patch('/conferences/${id}', function () {
    //register user for the conference
    //add conference to the user list
});
