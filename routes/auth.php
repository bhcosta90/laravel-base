<?php

declare(strict_types = 1);

use App\Livewire\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('validation', Auth\EmailValidation::class)->name('auth.email-validation');
});
