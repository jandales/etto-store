<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Services\Web\ProductServices;
use App\Http\Resources\Products\ProductResource;
use App\Http\Resources\ReviewResource;
use App\Services\Web\ReviewServices;

class ShowController extends Controller
{
    public function __invoke(Category $category, Product $product, ProductServices $services, ReviewServices $reviewServices)
    {             
        return Inertia::render('App/Show', [
            'product' => ProductResource::make($services->get($product)),   
            'ratings' => $reviewServices->getProductRatings($product->id),
        ]);
    }    
    
}
