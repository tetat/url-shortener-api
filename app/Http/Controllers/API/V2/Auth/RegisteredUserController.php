<?php

namespace App\Http\Controllers\API\V2\Auth;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;

class RegisteredUserController extends Controller
{
    public function __construct(private UserService $userService)
    {
        
    }

    public function store(StoreUserRequest $request)
    {
        $data = $this->userService->store($request->all());

        return response()->json($data, $data['status_code']);
    }
}
