<?php

use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::inertia('privacy-policy', 'privacy/PrivacyPolicy');
Route::inertia('terms-conditions', 'privacy/TermsConditions');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ShortUrlController::class, 'index'])->name('dashboard');
    Route::inertia('create', 'Create')->name('create');
});

require __DIR__ . '/settings.php';

Route::get('/{short_code}', [ShortUrlController::class, 'redirect']);

Route::post('/urls', [ShortUrlController::class, 'store'])->middleware('throttle:10,1');
Route::delete('/urls/{id}', [ShortUrlController::class, 'destroy'])->middleware('throttle:10,1');

Route::get('/auth/google/redirect', [SocialController::class, 'redirect'])->name('auth.google.redirect')->middleware('throttle:10,1');
Route::get('/auth/google/callback', [SocialController::class, 'callback'])->middleware('throttle:10,1');

// override Fortify's verification route so it works for guests 
Route::get('/email/verify/{id}/{hash}', [ProfileController::class, 'verifyEmail'])->name('verification.verify')->middleware(['signed', 'throttle:6,1']);

Route::get('/{short_code}/password', [ShortUrlController::class, 'showPasswordForm'])->name('shorturls.password.form');
Route::post('/{short_code}/password', [ShortUrlController::class, 'verifyPassword'])
    ->name('shorturls.password.verify')
    ->middleware('throttle:5,1');
