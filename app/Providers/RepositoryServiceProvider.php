<?php

namespace App\Providers;

use App\Repositories\{
    CompanyRepository,
    RoleRepository
};

use App\Repositories\Contracts\{
    CompanyContract,
    RoleContract
};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CompanyContract::class, CompanyRepository::class);
        $this->app->bind(RoleContract::class, RoleRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
