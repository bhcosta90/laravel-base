<?php

namespace BRCas\User\Providers;

use BRCas\Package\Providers\PackageServiceProvider;
use Illuminate\Support\ServiceProvider;

class UserProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(PackageServiceProvider::class);
        $this->registerConfig();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        if (function_exists('config_path')) {
            $this->publishes([
                realpath(__DIR__.'/../Config/config.php') => config_path('user.php'),
            ]);
        }

        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php',
            'user'
        );
    }

    public function boot()
    {
        $this->registerViews();
        $this->registerTranslations();
    }

    public function registerViews()
    {
        $viewPath = resource_path('views/modules/user');

        $sourcePath = __DIR__  . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', 'user']);

        $this->loadViewsFrom($sourcePath, "user");
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . "/../Resources/lang", "user");
    }
}