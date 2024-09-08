<?php

namespace Tests\Feature\UseCase;

use App\Repository\Interfaces\UsersRepositoryInterface;
use App\Security\Interfaces\PasswordHashInterface;
use App\UseCase\AddUserUseCase;
use Tests\TestCase;

class AddUserUseCaseTest extends TestCase
{
    public function test_should_orchestrating_add_user_action_correctly()
    {
        $useCasePayload = [
            'email' => 'davidpinarto90@gmail.com',
            'password' => 'plain_password',
            'fullName' => 'david pinarto',
        ];
        $mockUsersRepositoryArgs = array_merge($useCasePayload, ['password' => 'encrypted_password']);

        /** @var PasswordHashInterface|\Mockery\MockInterface $mockPasswordHash */
        $mockPasswordHash = self::mock(PasswordHashInterface::class);
        $mockPasswordHash
            ->expects()
            ->hash()
            ->with($useCasePayload['password'])
            ->times(1)
            ->andReturn('encrypted_password');

        /** @var UsersRepositoryInterface|\Mockery\MockInterface $mockUsersRepository */
        $mockUsersRepository = self::mock(UsersRepositoryInterface::class);
        $mockUsersRepository
            ->expects()
            ->addUser()
            ->with($mockUsersRepositoryArgs)
            ->times(1);

        $addUserUseCase = new AddUserUseCase($mockUsersRepository, $mockPasswordHash);

        $addUserUseCase->execute($useCasePayload);
    }
}
