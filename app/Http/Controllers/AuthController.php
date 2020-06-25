<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;
use App\User;

class AuthController extends Controller
{
    /**
     * login api
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->toArray())) {
            return response()->json(['message' => 'Invalid Credentials']);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response()->json(['user' => auth()->user(), 'access_token' => $accessToken]);
    }

    /**
     * Register api
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $request['password'] = bcrypt($request['password']);
        $user = User::create($request->toArray());
        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([
            'user' => $user,
            'accessToken' => $accessToken
        ], 200);
    }
}
