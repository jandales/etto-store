<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\App\Cart\CartController;
use App\Http\Controllers\Web\App\Cart\UpdateCartController;
use App\Http\Controllers\Web\App\Cart\DestroyCartController;
use App\Http\Controllers\Web\App\Cart\StoreCartController;

Route::prefix('cart')->group(function () {
    Route::get('/', CartController::class);
    Route::post('/store', StoreCartController::class);
    Route::put('/update/{id}', UpdateCartController::class);
    Route::delete('/destory/{id}', DestroyCartController::class);
});