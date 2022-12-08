<?php 

namespace App\Services\Web;

use App\Models\Order;
use App\Models\OrderItem;
use PhpParser\Node\Expr\Cast\Double;

class OrderServices {

    public function getAll($status = null)
    {
        $user = auth()->user();

        return Order::with('items', 'items.product')
        ->where('user_id', $user->id)
        ->when($status, function ($query) use ($status) {
            if ($status != 'all') $query->where('status', $status);
        })->orderBy('id', 'desc')->paginate(10); 

    }

    public function get(Order $order)
    {
        $order->load(['items', 'items.product', 'billing', 'shipping',  'payment', 'payment.shippingMethod']);
        return $order;
    }




    
}