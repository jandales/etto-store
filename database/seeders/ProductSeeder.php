<?php

namespace Database\Seeders;

use App\Models\Stock;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            'https://tailwindui.com/img/ecommerce-images/product-page-02-secondary-product-shot.jpg',  
            'https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-01.jpg',
            'https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-02.jpg',
            'https://tailwindui.com/img/ecommerce-images/product-page-02-featured-product-shot.jpg',
        ];

        Product::factory(200)
            ->create()
            ->each(function ($product) use ($images) {
                Stock::create([
                    'qty' => 100,
                    'remarks' => null,
                    'product_id' => $product->id,
                ]);

                foreach($images as $image) {                 
                    
                    ProductImage::create([
                        'path' => $image,
                        'product_id' => $product->id,
                        'alt' =>  $product->slug,
                    ]);

                }              
        });

    }
}
