<?php

namespace App\Http\Controllers\Users\Auth;

use App\Models\PasswordReset;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetRequest;

class UpdatePasswordController extends Controller
{
    public function __invoke(PasswordResetRequest $request) 
    {
       
        $result = PasswordReset::where('token', $request->token)->first();       

        $result->user->update([
            'password' => $request->new_password,
        ]);

        PasswordReset::where('token', $request->token)->delete();

        return redirect()->route('login')->with([
            'success' => true,
            'message' => 'Password Successfully reset']);


    }
}
