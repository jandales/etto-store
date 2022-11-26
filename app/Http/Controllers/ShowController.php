<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Http\Resources\Products\ProductResource;
use App\Services\Web\ProductServices;

class ShowController extends Controller
{
    public function __invoke(Category $category, Product $product, ProductServices $services)
    {
        return Inertia::render('App/Show', [
            'product' => ProductResource::make($services->get($product)),       
        ]);
    }
}
