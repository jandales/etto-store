<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    protected $model = Address::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'phone' => fake()->phoneNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'region' => fake()->name(),
            'zipcode' => fake()->postcode(),
            'user_id' => 1,
            'billing' => false,
            'shipping' => false,
        ];
    }
}
