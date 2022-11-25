<?php

namespace App\Http\Controllers\Web\App\Orders;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Services\Web\OrderServices;

class ShowOrderController extends Controller
{
    public function __invoke(Order $order, OrderServices $services)
    {       
        // return OrderResource::make($services->get($order));
        return Inertia::render('App/Accounts/Orders/Details',[
            'order' => OrderResource::make($services->get($order)),
        ]);
    }
}
