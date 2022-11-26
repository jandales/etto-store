<?php

namespace App\Services\Web;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductServices 
{
    public function getAll($category, $request)
    {
        $sort =  $request->query('sort');
        $direction = $request->query('direction');

        $products = Product::with('category')
        ->when(Str::length($category) > 2, function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })
            ->when(!is_null($sort), function ($query) use ($sort, $direction) {
                if ($sort == 'featured') return $query->where($sort, 1);
                $query->orderBy($sort, $direction);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return $products;
    }

    public function get(Product $product) {
        $product->load('category');
        $product->load('images');
        $product->load('reviews');
        return $product;
    }

}