<?php

namespace  App\Action;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Web\CartServices;

class OrderAction
{

    private $order;
    private $cart;

    public function __construct(CartServices $cartServvies)
    {
        $this->cart  = $cartServvies;
    }

    public function createOrder(int $customer_id, float $total = 0, float $discount = 0, float $taxes = 0, string $coupon_code = null,  int $shipping_id, int $billing_id, string $status)
    {
        $order = Order::create([
            'total' => $total,
            'dicount' => $discount,
            'taxes' => $taxes,
            'coupon_code' => $coupon_code,
            'status' => $status,
            'user_id' => $customer_id,
            'shipping_id' => $shipping_id,
            'billing_id' => $billing_id,
        ]); 
        
        self::createOrderLine($order->id);
        
        return $order;

    }

    private function createOrderLine($order_id)
    {
        $cart_items = $this->cart->getItems();

        foreach ($cart_items as $item) {

            OrderItem::create([
                'order_id' => $order_id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'price' => $item->product->regular_price,
                'properties' => $item->properties,
            ]);
        }

       
    }

}
