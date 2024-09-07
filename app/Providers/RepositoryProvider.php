<?php

namespace App\Providers;

use App\Repository\Interfaces\UsersRepositoryInterface;
use App\Repository\UsersRepositoryPostgres;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UsersRepositoryInterface::class, function () {
            return new UsersRepositoryPostgres();
        });
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
