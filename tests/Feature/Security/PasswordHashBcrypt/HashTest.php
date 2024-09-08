<?php

namespace Tests\Feature\Security\PasswordHashBcrypt;

use App\Security\PasswordHashBcrypt;
use Tests\TestCase;

class HashTest extends TestCase
{
    public function test_should_encrypt_password_correctly()
    {
        $password = 'david pinarto';

        $passwordHashBcrypt = new PasswordHashBcrypt();

        $result = $passwordHashBcrypt->hash($password);

        self::assertNotEquals($password, $result);
    }
}
