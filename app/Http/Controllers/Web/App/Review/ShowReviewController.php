<?php

namespace App\Http\Controllers\Web\App\Review;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;

class ShowReviewController extends Controller
{
    public function __invoke(Review $review, Request $request)
    {   
        if ($request->wantsJson()){
            return ReviewResource::make($review);
        }
        
    }
}
