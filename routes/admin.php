<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function () {

    return Inertia::render('Admin/Index');
});

Route::get('/admin/login', function () {

    return Inertia::render('Admin/Login');
});

Route::get('/admin/products', function () {
    return Inertia::render('Admin/Products');
});

Route::get('/admin/orders', function () {
    return Inertia::render('Admin/Orders');
});
