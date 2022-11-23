<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            'https://tailwindui.com/img/ecommerce-images/home-page-02-edition-01.jpg',
            'https://tailwindui.com/img/ecommerce-images/home-page-02-edition-02.jpg',
            'https://tailwindui.com/img/ecommerce-images/home-page-02-edition-03.jpg',
        ];

        foreach($images as $image)
        {
            Category::factory()->create([
                'image' => $image
            ]);
        }
        
    }
}
