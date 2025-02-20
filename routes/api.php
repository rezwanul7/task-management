<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/auth/token', [AuthController::class, 'generateToken']);

// Protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    // Protected User API routes
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('tasks', TaskController::class);

    // Logout route
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/logout-everywhere', [AuthController::class, 'logoutEveryWhere']);
});
