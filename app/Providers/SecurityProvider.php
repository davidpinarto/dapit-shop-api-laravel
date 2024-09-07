<?php

namespace App\Providers;

use App\Security\Interfaces\PasswordHashInterface;
use App\Security\PasswordHashBcrypt;
use Illuminate\Support\ServiceProvider;

class SecurityProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PasswordHashInterface::class, function () {
            return new PasswordHashBcrypt();
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
