<?php

namespace App\Http\Controllers\Web\Payments;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;

class CreateOrderController extends Controller
{
    
    public function __invoke(Order $order)
    {
       
        $order = $order->load(['items', 'items.product', 'billing', 'shipping', 'shippingMethod', 'payment']);
       
        return Inertia::render('App/Checkout/Complete',[
            'order' => OrderResource::make($order),
        ]);
        
    }
}
