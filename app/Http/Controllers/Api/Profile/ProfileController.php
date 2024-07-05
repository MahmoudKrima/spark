<?php

namespace App\Http\Controllers\Api\Profile;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\Api\Profile\UpdateProfile;

class ProfileController extends Controller
{
    use ApiResponseTrait;

    public function profile()
    {
        return ApiResponseTrait::apiResponse(new UserResource(Auth::guard('api')->user()));
    }

    public function updateProfile(UpdateProfile $request)
    {
        $data = $request->validated();
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        auth('api')->user()
            ->update($data);
        return ApiResponseTrait::apiResponse(new UserResource(Auth::guard('api')->user()), 'Profile Updated Successfully');
    }
}
