<?php

namespace App\Services\Web;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Action\OrderAction;
use Illuminate\Support\Facades\Hash;

class CheckoutServices {

    private $cart;

    public function __construct(CartServices $cartServvies)
    {
        $this->cart  = $cartServvies;
    }


    public function createUserAccount($request)
    {
        $user = User::create([
            'email' => $request->email,
            'firstname' => $request->shipping['firstname'],
            'lastname'  => $request->shipping['lastname'],
            'password'  => Hash::make('password'),
        ]);

        if ( $request->same_as_shipping == false ) {
            
            $user->address()->create([
                'firstname' => $request->billing_firstname,
                'lastname' => $request->billing_lastname,
                'phone' => $request->billing_firstname,
                'street' => $request->billing_street,
                'city' => $request->billing_city,
                'region' => $request->billing_region,
                'country' => $request->billing_country,
                'zipcode' => $request->billing_postalCode,
                'billing' => true,
                'shipping' => false,
            ]);
        }

        $user->address()->create([
            'firstname' => $request->shipping_firstname,
            'lastname' => $request->shipping_lastname,
            'phone' => $request->shipping_firstname,
            'street' => $request->shipping_street,
            'city' => $request->shipping_city,
            'region' => $request->shipping_region,
            'country' => $request->shipping_country,
            'zipcode' => $request->shipping_postalCode,
            'billing' => $request->same_as_shipping ? true : false,
            'shipping' => true,
        ]);

        return $user;
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

        Self::createOrderLine($order->id);

        $this->cart->clearCart();
        
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