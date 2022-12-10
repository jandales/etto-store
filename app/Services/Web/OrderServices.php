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


    public function createOrder(array $attributes)       
    {
      

        $order = Order::create([
            'user_id' => $attributes['user_id'] ?? null,
            'total' => $attributes['total'] ?? 0,
            'dicount' => $attributes['discount'] ?? 0,
            'taxes' => $attributes['taxes'] ?? 0,
            'coupon_code' => $attributes['coupon_code'] ?? null,
            'status' => $attributes['status'],           
            'shipping_id' => $attributes['shipping_id'] ?? null,
            'billing_id' => $attributes['billing_id'] ?? null,
        ]);

        if (isset($attributes['cart_items']) == false) return $order; 

        foreach ($attributes['cart_items'] as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'price' => $item->product->regular_price,
                'properties' => $item->properties,
            ]);
        }

        return $order;


    }
    




    
}