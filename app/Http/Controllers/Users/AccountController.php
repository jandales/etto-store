<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use Exception;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index()
    {
        return Inertia::render('App/Accounts/Account');
    }

    public function update(UpdateRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = auth()->user();
            $user->firstname  = $validated['firstname'];
            $user->lastname = $validated['lastname'];
            $user->save();

            return redirect()->route('account')->with([
                'success' => true,
                'message' => 'Successfully saved',
            ]);
        } catch (Exception $e) {
            return Inertia::render('App/Accounts/Account', [
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
