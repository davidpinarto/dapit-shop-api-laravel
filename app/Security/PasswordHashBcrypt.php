<?php

namespace App\Security;

use App\Security\Interfaces\PasswordHashInterface;
use Illuminate\Support\Facades\Hash;

class PasswordHashBcrypt implements PasswordHashInterface
{
    public function hash(string $password): string
    {
        return Hash::make($password);
    }

    public function comparePassword(string $plain, string $encrypted): void
    {
        $isPasswordMatch = Hash::check($plain, $encrypted);

        if (! $isPasswordMatch) {
            throw new \Exception('wrong email or password');
        }
    }
}
