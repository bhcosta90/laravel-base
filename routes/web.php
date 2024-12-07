<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/info', fn () => phpinfo())->name('info');
    Route::get('dashboard', fn () => 'oi')->name('dashboard');
});

include __DIR__ . "/auth.php";
