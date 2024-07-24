<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register(CreateUserRequest $request)
    {
        $userData = $request->all();

        $user = User::create($userData);

        return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ],
            201
        );
    }
    public function login(LoginUserRequest $request): JsonResponse
    {
        $isValidUser = Auth::attempt($request->only('email', 'password'));

        if (! $isValidUser) {
            return response()->json(
                [
                    'message' => 'Invalid credentials.',
                    'status' => 401,
                ],
                401
            );
        }

        $user = User::firstWhere('email', $request->email);
        $token = $user->createToken('token for user of email: ' . $request->email)->plainTextToken;

        return response()->json([
                'message' => 'Authenticated',
                'token' => $token,
            ],
            200
        );
    }
}
