<?php

declare(strict_types = 1);

use App\Livewire\Auth;
use Illuminate\Support\Facades\Route;

Route::get('login', Auth\Login::class)->name('login');
Route::get('register', Auth\Register::class)->name('register');
Route::prefix('password')->as('password.')->group(function () {
    Route::get('recovery', Auth\Password\Recovery::class)->name('recovery');
    Route::get('reset', Auth\Password\Reset::class)->name('reset');
});
