<?php

declare(strict_types = 1);

use App\Livewire\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('validation', Auth\EmailValidation::class)->name('auth.email-validation');
});

Route::middleware('guest')->group(function () {
    Route::get('register', Auth\Register::class)->name('register');
    Route::get('password/recovery', fn () => 'oi')->name('password.recovery');
});
