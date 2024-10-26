<?php

namespace App\Http\Controllers\API\V1\Auth;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;

class AuthenticatedSessionController extends Controller
{
    public function __construct(private UserService $userService)
    {
        
    }

    public function store(LoginUserRequest $request)
    {
        $data = $this->userService->login($request->all());

        return response()->json($data, $data['statusCode']);
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Sign out successful'
        ]);
    }
}
