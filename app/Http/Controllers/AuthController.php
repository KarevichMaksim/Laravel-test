<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(RegistrationRequest $request)
    {
        User::create($request->validated());
        $token = Auth::attempt($request->validated());

        return $this->respondWithToken($token);
    }

    public function login(LoginRequest $request)
    {
        if (!$token = Auth::attempt($request->validated())) {
            return response()->noContent(401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->noContent();
    }

    public function profile()
    {
        return auth()->user();
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
        ]);
    }

}
