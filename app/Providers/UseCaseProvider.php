<?php

namespace App\Providers;

use App\Repository\Interfaces\UsersRepositoryInterface;
use App\Security\Interfaces\PasswordHashInterface;
use App\UseCase\AddUserUseCase;
use Illuminate\Support\ServiceProvider;

class UseCaseProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AddUserUseCase::class, function ($app) {
            $usersRepository = $app->make(UsersRepositoryInterface::class);
            $passwordHash = $app->make(PasswordHashInterface::class);
            return new AddUserUseCase($usersRepository, $passwordHash);
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
