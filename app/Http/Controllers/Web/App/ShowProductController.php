<?php

namespace App\Http\Controllers\Web\App;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Web\ProductServices;
use App\Http\Resources\Products\ProductResource;

class ShowProductController extends Controller
{
    public function __invoke(Product $product, ProductServices $services)
    {

    
        return Inertia::render('App/Show', [
            'product' => ProductResource::make($services->get($product)),
        ]);
    }
   
}
