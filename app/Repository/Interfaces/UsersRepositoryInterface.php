<?php

namespace App\Repository\Interfaces;

interface UsersRepositoryInterface
{
    public function addUser(array $userData): void;
}
