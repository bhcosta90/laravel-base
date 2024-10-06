<?php

declare(strict_types = 1);

namespace App\Dev\Provider;

use App\Dev\Livewire\{Env, Login};
use Illuminate\Support\ServiceProvider;
use Livewire;

class DevServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Livewire::component('dev.env', Env::class);
        Livewire::component('dev.login', Login::class);
    }

    public function boot(): void
    {
        //
    }
}
