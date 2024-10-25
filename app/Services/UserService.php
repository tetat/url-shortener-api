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
                'status_code' => 201,
                'message' => 'Registration successful'
            ];
        }

        return [
            'status' => 'error',
            'status_code' => 500,
            'message' => 'Internal server error'
        ];
    }

    public function login(array $user)
    {
        $existedUser = User::where('email', $user['email'])->first();

        if (! $user || ! Hash::check($user['password'], $existedUser->password)) {
            return [
                'status' => 'error',
                'status_code' => 403,
                'message' => 'Invalid credentials'
            ];
        }

        $token = $existedUser->createToken('auth_token')->plainTextToken;

        return [
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Login successful',
            'token' => $token,
            'token_type' => 'Bearer'
        ];
    }
}
