<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\Auth\LoginController;
use App\Http\Controllers\Users\Auth\RegisterController;


Route::group(['middleware' => 'guest'], function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'login');
    })->middleware('guest');

    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'index');
        Route::post('/register', 'store');
    });

    Route::get('/forgot-password', function () {
        return Inertia::render('App/Auth/ForgotPassword');
    });
});
