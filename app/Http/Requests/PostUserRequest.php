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
            'email.max' => 'Email tidak boleh lebih dari 255 karakter',
            'password.required' => 'Password wajib diisi',
            'fullName.required' => 'Nama lengkap wajib diisi',
            'fullName.max' => 'Nama tidak boleh lebih dari 100 karakter'
        ];
    }
}
