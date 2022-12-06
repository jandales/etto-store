<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Web\App\CookieController;
use App\Http\Controllers\Web\App\SearchController;
use App\Http\Controllers\Web\App\ShowProductController;
use App\Http\Controllers\Web\App\Orders\OrderController;
use App\Http\Controllers\Web\App\Review\StoreController;
use App\Http\Controllers\Web\App\Orders\ShowOrderController;
use App\Http\Controllers\Web\Payments\CreateOrderController;
use App\Http\Controllers\Web\App\Review\ShowReviewController;
use App\Http\Controllers\Web\App\Review\DestroyReviewController;
use App\Http\Controllers\Web\Payments\Paypal\PaymentCancelController;
use App\Http\Controllers\Web\Payments\Paypal\PaymentSuccessController;
use App\Http\Controllers\Web\Payments\Paypal\PaymentProccessController;

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

Route::get('/test', function() {
    return Inertia::render('App');
});

Route::get('/', HomeController::class);

Route::get('/collections/{category:slug?}', ShopController::class);

Route::get('/collections/{category:slug}/{product:slug}', ShowController::class);


Route::get('/contact-us', ContactUsController::class);
Route::post('/contact-us/send/message', MessageController::class);


Route::get('/cookie/cart/store', CookieController::class);

Route::get('/account/orders', OrderController::class);
Route::get('/account/orders/{order:number}/show', ShowOrderController::class);
Route::get('/product/{product:uuid}', ShowProductController::class);

Route::group(['middleware' => 'auth'], function () {
    Route::post('/review/{product:uuid}/store', StoreController::class);
    Route::delete('/review/{review:uuid}/destroy', DestroyReviewController::class);
    Route::get('/review/user/{review:user_id}/show', ShowReviewController::class); 
});

Route::get('/search', SearchController::class);

Route::get('/checkout', CheckoutController::class);


Route::get('/checkout/payment/paypal/proccess', PaymentProccessController::class)->name('paypal.process');
Route::get('/checkout/payment/paypal/success', PaymentSuccessController::class)->name('paypal.success');
Route::get('/checkout/payment/paypal/cancel',  PaymentCancelController::class)->name('paypal.cancel');

Route::get('/checkout/completed/order/{order}', CreateOrderController::class)->name('checkout.completed');


// Route::get('/test', TestController::class);

require(__DIR__ . './app/guest.php');

require(__DIR__ . './app/cart.php');

require(__DIR__ . './app/auth.php');

require(__DIR__ . '/admin.php');

require(base_path('src/Domains/Catalog/Route/catalog.php'));
