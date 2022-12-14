<?php

namespace App\Http\Controllers\Users\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\PasswordReset;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PasswordResetController extends Controller
{    
    public function __invoke($token)
    {       
        $validate = Self::validateToken($token);

        if (!$validate) return Inertia::render('Errors/SessionExpired',[
            'message' => "Password link expired",
            'code' => 419,
        ]);

        return Inertia::render('App/Auth/ResetPassword', [
            'token' => $token,
        ]); 
    }

    public function validateToken($token)
    {
        $result = PasswordReset::where('token', $token)->first();

        if (!$result) return false;   
     
        $hours = now()->diffInHours(Carbon::parse($result->created_at)); 

        return $hours <= 24;  
       
    }
}
