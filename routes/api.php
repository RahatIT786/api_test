<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\UserDetailController;
use App\Http\Controllers\UserPaymentController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\UserEnquiryFormController;

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
    Route::post('/payment', [UserPaymentController::class, 'store']);
    Route::get('/user-payments/{user_id}', [UserPaymentController::class, 'getUserPaymentsByUserId']);

    Route::post('/product',[ProductListController::class, 'store']);
    Route::get('/products',[ProductListController::class, 'index']);
    Route::put('/products/{id}', [ProductListController::class, 'update']);
    Route::post('/product/delete/{id}', [ProductListController::class, 'delete']);

    Route::get('/product-category',[ProductCategoryController::class, 'index']);
    Route::post('/product-category',[ProductCategoryController::class, 'store']);

    Route::get('/enquires',[UserEnquiryFormController::class, 'index']);
    Route::post('/enquiry', [UserEnquiryFormController::class, 'store']);
});
