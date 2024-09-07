<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|unique:users,email|max:255',
            'password' => 'required|string',
            'fullName' => 'required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email yang Anda masukkan sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'fullName.required' => 'Nama lengkap wajib diisi',
        ];
    }
}
