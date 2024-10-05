<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

include __DIR__ . '/auth.php';

Route::get('dashboard')->name('dashboard');
