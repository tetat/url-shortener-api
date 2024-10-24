<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class RegisteredUserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());

        return response()->json([
            'error' => 0,
            'message' => 'Registration successful'
        ], 201);
    }
}
