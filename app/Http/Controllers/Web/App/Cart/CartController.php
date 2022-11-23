<?php

namespace App\Http\Controllers\Web\App\Cart;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\Web\CartServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemResource;

class CartController extends Controller
{
    public function __invoke(CartServices $cart)
    {       
        return Inertia::render('App/Cart', [
            'cart' => [
                'items' => CartItemResource::collection($cart->getItems()),
                'subtotal' => 1000,
            ]
        ]);
    }
}
