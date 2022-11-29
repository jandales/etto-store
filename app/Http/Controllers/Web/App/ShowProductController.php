<?php

namespace App\Http\Controllers\Web\App;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Web\ReviewServices;
use App\Services\Web\ProductServices;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\Products\ProductResource;

class ShowProductController extends Controller
{
    public function __invoke(Request $request, Product $product, ProductServices $services, ReviewServices $reviewServices)
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
