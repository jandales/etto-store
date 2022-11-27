<?php

namespace App\Http\Controllers\Web\App\Review;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class DestroyReviewController extends Controller
{
    public function __invoke(Review $review)
    {
        $review->delete();

        return back()->with([
            'status' => [
                'success' => true,
                'message' => 'Successfuly Deleted',
            ],
        ]);
    }
}
