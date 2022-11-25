<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\Web\App\CookieController;
use App\Http\Controllers\Web\App\ShowProductController;
use App\Http\Controllers\Web\App\Orders\OrderController;
use App\Http\Controllers\Web\App\Orders\ShowOrderController;

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


Route::get('/', HomeController::class);

Route::get('/collections/{category:slug?}', ShopController::class);

Route::get('/collections/{category:slug}/{product:slug}', ShowController::class);

Route::get('/contact', function () {
    return Inertia::render('App/Contact');
});

Route::get('/cookie/cart/store', CookieController::class);


Route::get('/account/orders', OrderController::class);
Route::get('/account/orders/details', ShowOrderController::class);
Route::get('/product/{product:uuid}', ShowProductController::class);

require(__DIR__ . './app/guest.php');

require(__DIR__ . './app/cart.php');

require(__DIR__ . './app/auth.php');

require(__DIR__ . '/admin.php');

require(base_path('src/Domains/Catalog/Route/catalog.php'));
