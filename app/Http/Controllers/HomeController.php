<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Action\CookieAction;

class HomeController extends Controller
{
    public function __invoke(CookieAction $cookie)
    {    
        return Inertia::render('App/Home', [
                'collection' => Category::all(),
                'featured_products' => Product::Featured()->limit(4)->get(),               
            ]
        );
    }
}
