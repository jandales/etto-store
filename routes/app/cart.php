<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\App\Cart\CartController;
use App\Http\Controllers\Web\App\Cart\UpdateCartController;
use App\Http\Controllers\Web\App\Cart\DestroyCartController;
use App\Http\Controllers\Web\App\Cart\StoreCartController;

Route::prefix('cart')->group(function () {
    Route::get('/', CartController::class)->name('cart');
    Route::post('/store', StoreCartController::class)->name('cart.store');
    Route::put('/update/item/{id}/qty', UpdateCartController::class)->name('cart.update');
    Route::delete('/destroy/{id}', DestroyCartController::class)->name('cart.destroy');
});