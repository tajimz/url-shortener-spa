<?php

use App\Http\Controllers\Api\AppSettingsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
Route::post('/social-login', [AuthController::class, 'socialLogin'])->middleware('throttle:10,1');
Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');
Route::post('/urls', [ShortUrlController::class, 'store'])->middleware('throttle:10,1');
Route::get('/app-settings', [AppSettingsController::class, 'index']);


Route::middleware(['auth:sanctum'])->group(function () {


    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'index']);
    Route::patch('/me', [AuthController::class, 'update'])->middleware('throttle:15,1');
    Route::post('/verification/send', [AuthController::class, 'resendEmailVerification'])->middleware('throttle:5,1');

    Route::middleware(['auth:sanctum', 'verified'])
        ->prefix('urls')
        ->group(function () {
            Route::get('/', [ShortUrlController::class, 'index']);
            Route::get('/{id}', [ShortUrlController::class, 'show']);
            Route::delete('/{id}', [ShortUrlController::class, 'destroy'])->middleware('throttle:10,1');
        });
});
