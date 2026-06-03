<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ShortUrlController::class, 'index'])->name('dashboard');
    Route::inertia('create', 'Create')->name('create');
});

require __DIR__ . '/settings.php';

Route::get('/{short_code}', [ShortUrlController::class, 'redirect']);

Route::post('/urls', [ShortUrlController::class, 'store']);
Route::delete('/urls/{id}', [ShortUrlController::class, 'destroy']);
Route::get('/auth/google/redirect', [SocialController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [SocialController::class, 'callback']);

Route::get('/{short_code}/password', [ShortUrlController::class, 'showPasswordForm'])->name('shorturls.password.form');
Route::post('/{short_code}/password', [ShortUrlController::class, 'verifyPassword'])->name('shorturls.password.verify')->middleware('throttle:5,1');;
