<?php

namespace App\Http\Controllers\Users\Auth;


use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\EmailRequest;
use App\Http\Controllers\Controller;
use App\Jobs\ProccessForgotPassword;

class ForgotPasswordController extends Controller
{
    public function __invoke(EmailRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ( !$user ) return back()->with([
            'error' => true,
            'message' => 'Email not Found'    
        ]);

        $token = Str::random(24);

        $user->passwordReset()->create([
            'token' => $token,
            'created_at' => now(),
        ]);   

        $url = url("/account/password/reset/{$token}");

        dispatch(New ProccessForgotPassword($user->email, $url));    

        return back()->with([           
            'success' => true,
            'message' => 'Password reset link successfully send to email'            
        ]);      
       
    }
}
