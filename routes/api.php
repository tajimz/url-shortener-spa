<?php

use App\Http\Controllers\Api\AppSettingsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/urls', [ShortUrlController::class, 'store']);
Route::get('/app-settings', [AppSettingsController::class, 'index']);


Route::middleware(['auth:sanctum'])->group(function () {


    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'index']);
    Route::patch('/me', [AuthController::class, 'update']);
    Route::post('/verification/send', [AuthController::class, 'resendEmailVerification']);


    Route::middleware(['auth:sanctum', 'verified'])
        ->prefix('urls')
        ->group(function () {
            Route::get('/', [ShortUrlController::class, 'index']);
            Route::get('/{id}', [ShortUrlController::class, 'show']);
            Route::delete('/{id}', [ShortUrlController::class, 'destroy']);
        });
});
