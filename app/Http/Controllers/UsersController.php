<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUserRequest;
use App\UseCase\AddUserUseCase;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    private $addUserUseCase;

    public function __construct(AddUserUseCase $addUserUseCase)
    {
        $this->addUserUseCase = $addUserUseCase;
    }

    public function postUserHandler(PostUserRequest $request): JsonResponse
    {
        $validatedUserData = $request->validated();

        $this->addUserUseCase->execute($validatedUserData);

        $response = [
            'status' => 'success',
            'message' => 'registration success!'
        ];
        return response()->json($response, 201);
    }
}
