<?php

declare(strict_types = 1);

use App\Livewire;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

include __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', Livewire\Dashboard::class)->name('dashboard');
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::get('user', Livewire\Admin\User\UserIndex::class)->name('user');
    });
});
