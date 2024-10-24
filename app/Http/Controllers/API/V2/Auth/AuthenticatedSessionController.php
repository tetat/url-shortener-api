<?php

namespace App\Http\Controllers\API\V2\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginUserRequest $request)
    {
        $creds = $request->validated();

        $user = User::where('email', $creds['email'])->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 1,
                'message' => 'Invalid credentials'
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'error' => 0,
            'message' => 'Login successful',
            'token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'error' => 0,
            'message' => 'Sign out successful'
        ]);
    }
}
