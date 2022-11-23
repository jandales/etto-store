<?php

namespace App\Http\Controllers\Users\Auth;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;

class LoginController extends Controller
{
    public function index()
    {
        return Inertia::render('App/Auth/Login');
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $user = auth()->attempt($validated);

        if ($user) {
            return redirect()->route('account');
        }

        return back()->with('error', 'email not found');
    }
}
