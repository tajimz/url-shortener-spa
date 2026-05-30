<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/urls', [ShortUrlController::class, 'index']);
    Route::post('/urls', [ShortUrlController::class, 'store']);
    Route::get('/urls/{id}', [ShortUrlController::class, 'show']);
    Route::delete('/urls/{id}', [ShortUrlController::class, 'destroy']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
Route::post('/public/shorten', [ShortUrlController::class, 'storePublic'])
    ->middleware('throttle:10,1');
