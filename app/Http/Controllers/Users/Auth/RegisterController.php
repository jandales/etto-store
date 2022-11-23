<?php

namespace App\Http\Controllers\Users\Auth;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRegisterRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return Inertia::render('App/Auth/Register');
    }

    public function store(UserRegisterRequest $request)
    {
        $validated = $request->validated();
        User::create($validated);
        return redirect()->route('login');
    }
}
