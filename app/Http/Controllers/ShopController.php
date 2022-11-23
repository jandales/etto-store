<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\Web\ProductServices;
use App\Http\Resources\Products\ProductResource;


class ShopController extends Controller
{
    public function __invoke(Category $category, Request $request, ProductServices $services)
    {
        
        $products = $services->getAll($category, $request);    

        if ($request->wantsJson()) {
            return ProductResource::collection($products);
        };

        return Inertia::render('App/Shop',[
                'collections' => Category::all(),
                'res_products' => ProductResource::collection($products),
                'selected_category' => $category->name ?? 'All Collection',
                'sort' => $sort ?? null,
                'direction' => $direction ?? null,
            ]
        );

    }
    
}
