<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/urls', [ShortUrlController::class, 'index']);
    Route::get('/urls/{id}', [ShortUrlController::class, 'show']);
    Route::delete('/urls/{id}', [ShortUrlController::class, 'destroy']);
});
Route::post('/urls', [ShortUrlController::class, 'store']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/verification/send', [AuthController::class, 'resendEmailVerification']);
    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});
