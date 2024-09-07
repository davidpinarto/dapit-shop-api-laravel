<?php

namespace App\Repository;

use App\Models\Users;
use App\Repository\Interfaces\UsersRepositoryInterface;
use Illuminate\Support\Str;

class UsersRepositoryPostgres implements UsersRepositoryInterface
{
    public function addUser(array $userData): void
    {
        [
            'email' => $email,
            'password' => $password,
            'fullName' => $fullName
        ] = $userData;
        $id = "user-" . Str::random(16);

        $mappingUserData = [
            'id' => $id,
            'email' => $email,
            'password' => $password,
            'full_name' => $fullName
        ];

        /** TODO
         *  use Queue, Jobs, and Worker to insert data
         */
        Users::insert($mappingUserData);
    }
}
