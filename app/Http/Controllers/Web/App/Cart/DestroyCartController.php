<?php

namespace App\Http\Controllers\Web\App\Cart;

use Illuminate\Http\Request;
use App\Services\Web\CartServices;
use App\Http\Controllers\Controller;
use App\Models\CartItem;

class DestroyCartController extends Controller
{
    public function __invoke($id, CartServices $cartServices)
    {

        try {
            $result = $cartServices->destroyItem($id);
            return back()->with([
                'status' => [
                    'message' => 'successfully Deleted',
                    'success' => $result,
                ],
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }       

    }
}
