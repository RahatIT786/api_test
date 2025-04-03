<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\UserDetailController;
use App\Http\Controllers\UserPaymentController;

// Public Routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Protected Routes
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/refresh', [UserController::class, 'refresh']);
    Route::get('/profile', [UserController::class, 'profile']);

    Route::post('/userdetail', [UserDetailController::class, 'createUserDetail']);
    Route::get('/userdetails', [UserDetailController::class, 'getUserDetail']);
    Route::put('/userdetails/{id}/delete', [UserDetailController::class, 'deleteUserDetail']);
    Route::get('/get_user_detail/{id}',[UserDetailController::class, 'getUserDetailForUpdate']);
    Route::put('/userdetails/{id}', [UserDetailController::class, 'updateUserDetail']);

    Route::get('/payments', [UserPaymentController::class, 'index']);
    Route::post('/payments', [UserPaymentController::class, 'store']);
    Route::get('/user-payments/{user_id}', [UserPaymentController::class, 'getUserPaymentsByUserId']);

});
