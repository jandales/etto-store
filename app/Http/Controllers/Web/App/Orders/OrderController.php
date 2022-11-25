<?php

namespace App\Http\Controllers\Web\App\Orders;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\Web\OrderServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function __invoke(Request $request, OrderServices $order)
    {
        return Inertia::render('App/Accounts/Orders/Index', [
            'orders' => OrderResource::collection($order->getAll()),
        ]);
    }

}
