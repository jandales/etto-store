<?php

namespace App\Http\Controllers\Web\App\Review;

use App\Models\Review;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Services\Web\ReviewServices;
use App\Http\Requests\StoreReviewRequest;

class StoreController extends Controller
{
       public  function __invoke(Product $product, StoreReviewRequest $request, ReviewServices $review)
       {
      
        $user = auth()->user();        

        $review->write(
            $product->id, 
            $user->id,
            $request->rate,
            $request->body
        );       

        return back()->with([
            'message' => 'Successfully Submitted',
            'success' => true,
        ]); 
        
       }
}
