<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    { 
        $product = Product::find(rand(1, 200));
        
        return [
            'order_id' => Order::findOrFail(1)->id,
            'product_id' => $product->id,
            'qty' => 1,
            'price'=> $product->regular_price,
            'properties' => [
                'color' => 'Black',
                'size' => 'Lg',
            ]
        ];
    }
}
