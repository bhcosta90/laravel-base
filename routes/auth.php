<?php

declare(strict_types = 1);

use App\Livewire\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('validation', Auth\EmailValidation::class)->name('auth.email-validation');
});

Route::middleware('guest')->group(function () {
    Route::get('login', fn () => 'oi')->name('login');
    Route::get('register', Auth\Register::class)->name('register');
    Route::get('password/recovery', Auth\Password\Recovery::class)->name('password.recovery');
    Route::get('password/reset', Auth\Password\Reset::class)->name('password.reset');
});
