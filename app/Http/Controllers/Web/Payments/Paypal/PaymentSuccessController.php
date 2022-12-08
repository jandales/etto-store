<?php

namespace App\Http\Controllers\Web\Payments\Paypal;

use App\Action\OrderAction;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Jobs\ProccessOrderMail;
use App\Models\OrderItem;
use App\Services\Web\CartServices;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Payment;
use App\Services\Web\OrderServices;

class PaymentSuccessController extends Controller
{
    public function __invoke(Request $request, CartServices $cartServices, OrderAction $action)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request['token']);     

        if (!isset($response)) return redirect()->route('paypal')->with([
            'error' => true,
            'message' => 'Something went wrong'
        ]);

        if (isset($response) && $response['status'] == 'COMPLETED') {

            $order = DB::transaction(function () use ($response, $cartServices, $action) {
             
                $transaction_id = $response['purchase_units'][0]['payments']['captures'][0]['id'];

                $payment = Payment::where('reference_number', $response['id'])->first();  

                $order = $action->createOrder(
                    customer_id : auth()->user()->id,
                    total : $payment->amount,
                    discount : 0,
                    taxes : 0,
                    coupon_code : null,
                    shipping_id : auth()->user()->shipping()->id,                    
                    billing_id : auth()->user()->billing()->id,
                    status : 'confirmed',
                );
             
                $cartServices->clearCart();
             
                $payment->reference_number = $transaction_id;
                $payment->order_id = $order->id;
                $payment->status = strtolower($response['status']);
                $payment->save();   
                
                dispatch(new ProccessOrderMail($order));
                
                return $order;

            });
      
            return redirect()->route('checkout.completed', $order);    

        }
    }
}
