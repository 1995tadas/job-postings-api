<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function refresh(): \Illuminate\Http\JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken(string $token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        if ($token = auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user) {
            $auth = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            if ($auth) {
                return $this->respondWithToken($auth);
            }

            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['error' => 'Internal server error'], 500);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out'], 205);
    }
}
