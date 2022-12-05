<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\Web\CartServices;
use App\Http\Resources\CartItemResource;
use App\Models\ShippingMethod;

class CheckoutController extends Controller
{
   
    public function __invoke(CartServices $cartServices)
    {
        $cart_items = $cartServices->getItems();

        if ($cart_items->count() === 0) return redirect()->route('cart');
        
        return Inertia::render('App/Checkout/Index', [
            'cart' =>  [
                'items' => CartItemResource::collection($cartServices->getItems()),
                'subtotal' =>  $cartServices->getSubtotal(),                            
            ],
            'shippingMethods' => ShippingMethod::all(),
            'address' => [
                'shipping' => auth()->user() ? auth()->user()->shipping() : null,
                'billing' => auth()->user() ? auth()->user()->billing() : null,
            ]
        ]);
    }
}
