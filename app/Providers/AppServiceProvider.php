<?php

declare(strict_types = 1);

namespace App\Providers;

use App\Actions\VerifyMenu;
use App\Dev\Provider\DevServiceProvider;

use function auth;

use Illuminate\Support\Facades\Route;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        if (!$this->app->environment('production')) {
            $this->app->register(DevServiceProvider::class);
        }

        $this->app->bind(VerifyMenu::class, function () {
            return new VerifyMenu(auth()->user(), Route::currentRouteName());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
