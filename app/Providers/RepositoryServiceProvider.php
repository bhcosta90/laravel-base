<?php

namespace App\Providers;

use App\Repositories\{
    CompanyRepository,
    RoleRepository,
    UserRepository
};

use App\Repositories\Contracts\{
    CompanyContract,
    RoleContract,
    UserContract
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
        $this->app->bind(UserContract::class, UserRepository::class);
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
