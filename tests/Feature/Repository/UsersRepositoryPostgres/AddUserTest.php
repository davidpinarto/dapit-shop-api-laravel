<?php

namespace Tests\Feature\Repository\UsersRepositoryPostgres;

use App\Models\Users;
use App\Repository\UsersRepositoryPostgres;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AddUserTest extends TestCase
{
    public function test_should_add_new_user_data_on_database()
    {
        $userData = [
            'email' => 'davidpinarto90@gmail.com',
            'password' => Hash::make('plain_password'),
            'fullName' => 'david pinarto',
        ];

        $usersRepositoryPostgres = new UsersRepositoryPostgres();

        $usersRepositoryPostgres->addUser($userData);

        $user = Users::where('email', '=', $userData['email'])->first();

        self::assertNotNull($user);
        self::assertEquals($userData['email'], $user->email);
        self::assertTrue(Hash::check('plain_password', $user->password));
        self::assertEquals($userData['fullName'], $user->full_name);
    }
}
