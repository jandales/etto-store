<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\AccountController;
use App\Http\Controllers\Users\AddressController;
use App\Http\Controllers\Users\Auth\LogoutController;

Route::group(['middleware' => 'auth'], function () {

    Route::controller(AccountController::class)->group(function () {
        Route::post('/account/update', 'update');
        Route::get('/account', 'index')->name('account');
    });

    Route::post('/logout', [LogoutController::class, 'index']);

    Route::controller(AddressController::class)->group(function () {
        Route::get('/account/address', [AddressController::class, 'index'])->name('account.address');
        Route::get('/account/address/create', [AddressController::class, 'create'])->name('account.create');
        Route::get('/account/address/edit/{address:id}', [AddressController::class, 'edit'])->name('account.edit');
        Route::post('/account/address/store', [AddressController::class, 'store'])->name('account.store');
        Route::put('/account/address/update/{address:id}', [AddressController::class, 'update'])->name('account.update');
        Route::put('/account/address/{address:id}/setShipping', [AddressController::class, 'shipping']);
        Route::put('/account/address/{address:id}/setBilling', [AddressController::class, 'billing']);
        Route::delete('/account/address/{address:id}/destroy', [AddressController::class, 'destroy']);
    });
});
