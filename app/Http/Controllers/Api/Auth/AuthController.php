<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'user';
        $user = User::create($data);
        Auth::guard('api')
            ->login($user);
        $token = Auth::guard('api')
            ->login($user);
        return ApiResponseTrait::apiResponse(['user' => new UserResource($user), 'token' => $token], 'Registered Successfully');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if (!$token = auth('api')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return ApiResponseTrait::apiResponse([], 'Wrong Password Or Email', [], 422);
        }
        return ApiResponseTrait::apiResponse(['user' => new UserResource(Auth::guard('api')->user()), 'token' => $this->respondWithToken($token)], 'Login Successfully');
    }

    protected function respondWithToken($token)
    {
        return $token;
    }

    public function logout()
    {
        Auth::guard('api')
            ->logout();
        return ApiResponseTrait::apiResponse([], 'Logout Successfully');
    }
}
