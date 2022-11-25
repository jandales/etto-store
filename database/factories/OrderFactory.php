<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::findOrFail(1); 

        return [           
            'gross_total' => rand(1000, 5000),
            'tax_total' => rand(100, 500),
            'net_total' => rand(1000, 5000),
            'shipped_at' => null,
            'cancelled_at' => null,
            'returned_at' => null,
            'completed_at' => null,
            'coupon_id' => null,
            'coupon_amount' => 0,
            'shipping_method_id' => null,
            'shipping_charge' => 0,
            'status' => 'pending',
            'user_id' => $user->id,
            'shipping_id' => $user->shipping()->id,
            'billing_id' => $user->billing()->id,
        ];
    }
}
