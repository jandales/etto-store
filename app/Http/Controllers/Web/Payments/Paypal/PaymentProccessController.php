<?php

namespace App\Http\Controllers\Web\Payments\Paypal;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Web\CheckoutServices;
use App\Action\Payment as PayPalPayment;
use App\Services\Web\CartServices;
use App\Services\Web\OrderServices;
use App\Services\Web\ProccessPaymentServices;
use Dotenv\Parser\Value;
use Illuminate\Support\Facades\Redirect;


class PaymentProccessController extends Controller
{    
    public function __invoke(Request $request, ProccessPaymentServices $proccessPaymentServices, OrderServices $orderServices, CartServices $cartServices)
    {
        $data = array_merge($request->all(), [
            'cart_items' => $cartServices->getItems(),
        ]);

        $link = $proccessPaymentServices
                ->init($request->amount)
                ->createOrder($data, $orderServices)
                ->getLinkApproved();

        if (isset($link) && $link != null) {

            return Redirect::away($link);

        }

       return redirect()->route('checkout')->with('error', 'Something went wrong.');  
        
    }
}
