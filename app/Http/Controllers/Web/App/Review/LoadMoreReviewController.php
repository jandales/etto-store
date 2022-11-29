<?php

namespace App\Http\Controllers\Web\App\Review;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Services\Web\ReviewServices;
use App\Http\Resources\ReviewResource;

class LoadMoreReviewController extends Controller
{
    public function __invoke(Product $product, ReviewServices $services)
    {        
        return ReviewResource::collection($services->getProductReviews($product->id));
    }
}
