<?php

namespace App\Http\Controllers\Web\App\Cart;

use App\Http\Controllers\Controller;
use App\Services\Web\CartServices;
use Illuminate\Http\Request;

class UpdateCartController extends Controller
{
    public function __invoke($id, Request $request, CartServices $cartServices)
    {
    
        try {
            $cartServices->updateItemQuantity($id, $request->qty);
            return back()->with([
                'status' => [
                    'message' => 'successfully Updated',
                    'success' => true,
                ],
            ]);
        } catch (\Exception $e) {
            return $e;
        }       

    }
}
