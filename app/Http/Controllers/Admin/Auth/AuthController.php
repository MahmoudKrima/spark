<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], true)) {
            $user = User::where('email', $data['email'])
                ->first();
            Auth::login($user, true);
            return redirect()
                ->to(route('admin.home'));
        }
        return back()
            ->with('Error', 'Wrong Email Or Password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()
            ->to(route('auth.index'));
    }
}
