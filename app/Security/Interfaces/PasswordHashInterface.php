<?php

namespace App\Security\Interfaces;

interface PasswordHashInterface
{
    public function hash(string $password): string;
    public function comparePassword(string $plain, string $encrypted): void;
}
