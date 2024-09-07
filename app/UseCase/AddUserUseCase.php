<?php

namespace App\UseCase;

use App\Repository\Interfaces\UsersRepositoryInterface;
use App\Security\Interfaces\PasswordHashInterface;

class AddUserUseCase
{
    private $userRepository;
    private $passwordHash;

    public function __construct(UsersRepositoryInterface $userRepository, PasswordHashInterface $passwordHash)
    {
        $this->userRepository = $userRepository;
        $this->passwordHash = $passwordHash;
    }

    public function execute(array $useCasePayload): void
    {
        ['password' => $password] = $useCasePayload;
        $useCasePayload['password'] = $this->passwordHash->hash($password);
        $this->userRepository->addUser($useCasePayload);
    }
}
