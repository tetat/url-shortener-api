<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store(array $user)
    {
        if (User::create($user)) {
            return [
                'status' => 'success',
                'statusCode' => 201,
                'message' => 'Registration successful'
            ];
        }

        return [
            'status' => 'error',
            'statusCode' => 500,
            'message' => 'Internal server error'
        ];
    }

    public function login(array $user)
    {
        $existedUser = User::where('email', $user['email'])->first();

        if (! $existedUser || ! Hash::check($user['password'], $existedUser->password)) {
            return [
                'status' => 'error',
                'statusCode' => 401,
                'message' => 'Invalid credentials'
            ];
        }

        $token = $existedUser->createToken('auth_token')->plainTextToken;

        return [
            'status' => 'success',
            'statusCode' => 200,
            'message' => 'Login successful',
            'token' => $token,
            'token_type' => 'Bearer'
        ];
    }
}
