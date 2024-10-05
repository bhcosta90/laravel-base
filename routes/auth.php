<?php

declare(strict_types = 1);

use App\Livewire\Auth;
use Illuminate\Support\Facades\Route;

Route::get('login', Auth\Login::class)->name('login');
