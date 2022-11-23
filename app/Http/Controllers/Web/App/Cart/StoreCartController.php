<?php

namespace App\Http\Controllers\Web\App\Cart;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Exceptions\ExistProductException;
use App\Exceptions\CartItemExistException;
use App\Exceptions\CartNotFoundException;
use App\Services\Web\CartServices;

class StoreCartController extends Controller
{
    public function __invoke(Request $request, CartServices $cart)
    {  
        try {           
           $cart->addItem($request->product_id, $request->qty, $request->properties);
            return back()->with([
                'success' => true,
                'message' => 'Successfully Added to your cart',
            ]);
        }       
        catch (CartItemExistException $e) {               
            return back()->with([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }         
    }
}
