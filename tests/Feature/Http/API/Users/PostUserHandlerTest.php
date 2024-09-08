<?php

namespace Tests\Feature\Http\API\Users;

use App\Models\Users;
use Tests\TestCase;

class PostUserHandlerTest extends TestCase
{
    public function test_should_response_201_and_create_new_user()
    {
        $requestBody = [
            'email' => 'davidpinarto90@gmail.com',
            'password' => 'hebatsekali',
            'fullName' => 'david pinarto'
        ];
        $responseMessage = [
            'status' => 'success',
            'message' => 'registration success!'
        ];

        $response = self::post('/api/users', $requestBody);

        $response->assertStatus(201);
        $response->assertJson($responseMessage);
        self::assertDatabaseHas(Users::class, ['email' => $requestBody['email']]);
    }

    public function test_should_response_400_when_request_body_not_contain_needed_property()
    {
        $requestBody = [
            'email' => 'davidpinarto90@gmail.com',
            'fullName' => 'david pinarto'
        ];
        $responseMessage = [
            'status' => 'fail',
            'message' => 'Password wajib diisi'
        ];

        $response = self::post('/api/users', $requestBody);

        $response->assertStatus(400);
        $response->assertJson($responseMessage);
    }

    public function test_should_response_400_when_email_address_is_already_used()
    {
        Users::insert([
            'id' => 'davidpinarto',
            'email' => 'davidpinarto90@gmail.com',
            'password' => 'hebatsekali',
            'full_name' => 'david pinarto'
        ]);

        $requestBody = [
            'email' => 'davidpinarto90@gmail.com',
            'password' => 'hebatsekali',
            'fullName' => 'david pinarto'
        ];

        $responseMessage = [
            'status' => 'fail',
            'message' => 'Email yang Anda masukkan sudah digunakan'
        ];

        $response = self::post('/api/users', $requestBody);

        $response->assertStatus(400);
        $response->assertJson($responseMessage);
    }

    public function test_should_response_400_when_full_name_more_than_100_character()
    {
        $requestBody = [
            'email' => 'davidpinarto90@gmail.com',
            'password' => 'hebatsekali',
            'fullName' => str_repeat('david pinarto', 8)
        ];

        $responseMessage = [
            'status' => 'fail',
            'message' => 'Nama tidak boleh lebih dari 100 karakter'
        ];

        $response = self::post('/api/users', $requestBody);

        $response->assertStatus(400);
        $response->assertJson($responseMessage);
    }

    public function test_should_response_400_when_email_more_than_255_character()
    {
        $requestBody = [
            'email' => str_repeat('davidpinarto90@gmail.com', 11),
            'password' => 'hebatsekali',
            'fullName' => 'david pinarto'
        ];

        $responseMessage = [
            'status' => 'fail',
            'message' => 'Email tidak boleh lebih dari 255 karakter'
        ];

        $response = self::post('/api/users', $requestBody);

        $response->assertStatus(400);
        $response->assertJson($responseMessage);
    }
}
