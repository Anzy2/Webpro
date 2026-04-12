<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Login
Route::get('/login', [AuthController::class, 'login']);
Route::post('/auth', [AuthController::class, 'auth']);

// Register
Route::get('/registration', [AuthController::class, 'registration']);
Route::post('/register', [AuthController::class, 'register']);

// Home
Route::get('/home', [AuthController::class, 'home']);

// Logout
Route::get('/logout', [AuthController::class, 'logout']);