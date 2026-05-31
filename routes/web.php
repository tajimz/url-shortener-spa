<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::inertia('create', 'Create')->name('create');
});

require __DIR__ . '/settings.php';

Route::get('/{short_code}', [ShortUrlController::class, 'redirect']);

Route::post('/urls', [ShortUrlController::class, 'store']);
Route::delete('/urls/{id}', [ShortUrlController::class, 'destroy']);
