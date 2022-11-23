<?php

namespace App\Observers\User;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        Profile::create(['user_id' => $user->id]);
    }

    public function updated(User $user)
    {
        $profile = $user->profile;
        $profile->phone = request()->phone;
        $profile->birth_date = request()->birth_date;
        $profile->save();
    }
}
