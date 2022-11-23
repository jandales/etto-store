<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $name = fake()->word();
        $images = [
            'https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-01.jpg',
            'https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-02.jpg',
            'https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-03.jpg',
            'https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-04.jpg',
            'https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-05.jpg',
            'https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-06.jpg',
            'https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-07.jpg',
        ];
        return [
            'name' => $name,
            'category_id' => rand(1, 3),
            'slug' => Str::slug(strtolower($name)),
            'short_description' => fake()->sentence(),
            'long_description' => fake()->sentence(20),
            'imagePath' => $images[rand(0, 6)],
            'sku' => Str::random(12),
            'barcode' => Str::random(12),
            'tags' => $name,
            'sale_price' => rand(1000, 5000),
            'regular_price' => rand(1000, 5000),
            'status' => 1,
            'featured' => rand(0, 1),
        ];
    }
}
