<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\Web\ReviewServices;
use App\Services\Web\ProductServices;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\Products\ProductResource;

class ShowController extends Controller
{
    public function __invoke(Category $category, Request $request, Product $product, ProductServices $services, ReviewServices $reviewServices)
    {

        $reviews = ReviewResource::collection($reviewServices->getProductReviews($product->id));

        if ($request->wantsJson()) {
            return $reviews;
        }

        return Inertia::render('App/Show', [
            'product' => ProductResource::make($services->get($product)),   
            'ratings' => $reviewServices->getProductRatings($product->id),
            'reviews' => $reviews,
        ]);

    }
    

    
}
