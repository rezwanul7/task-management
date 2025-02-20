<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'email' => [
                'description' => 'The email of the user',
                'example' => 'test@example.com',
            ],
            'password' => [
                'description' => 'The password of the user',
                'example' => 'password',
            ],
        ];
    }
}
