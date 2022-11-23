<?php

namespace App\Http\Controllers\Web\App\Cart;

use Inertia\Inertia;
use App\Action\Currency;
use Illuminate\Http\Request;
use App\Services\Web\CartServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemResource;

class CartController extends Controller
{
    public function __invoke(CartServices $cart, Request $request)
    {
        $cart =  [
            'items' => CartItemResource::collection($cart->getItems()),
            'subtotal' => $cart->getSubtotal(),
            'currency' => [
                'country' => 'PHP',
                'sign' => '₱',
            ]
        ];
            
        if ($request->wantsJson()) {
            return response()->json([
                'cart' => $cart,
            ]);
        }
      
        return Inertia::render('App/Cart', [
            'cart' => $cart,                            
        ]);
    }
}
