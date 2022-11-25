<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [            
            'reference_number' => Order::find(1)->number,
            'provider' => 'paypal',
            'amount' => rand(1000, 5000),
            'status'  => 'paid'
        ];
    }
}
