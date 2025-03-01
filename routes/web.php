<?php

declare(strict_types = 1);

use App\Livewire\{Auth, Welcome};
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class);

Route::get('/login', Auth\Login::class);
