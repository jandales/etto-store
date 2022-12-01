<?php

namespace App\Http\Controllers\Web\App;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductResource;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
    
        $keyword = $request->keyword  ?? 'null';

        $products = Product::search($keyword)->with('category')->get();

        if ($request->wantsJson()) {
            return  ProductResource::collection($products);
        }

        return Inertia::render(
            'App/Search', [             
                'products' => ProductResource::collection($products),
                'keyword' => $keyword,
            ]
        );
    }
}
