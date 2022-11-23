<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\User\UserObserver;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class UserProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
