<?php

namespace App\Http\Controllers\Web\Payments\Paypal;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Jobs\ProccessOrderMail;
use App\Models\OrderItem;
use App\Services\Web\CartServices;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Payment;

class PaymentSuccessController extends Controller
{
    public function __invoke(Request $request, CartServices $cartServices)
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

            $order = DB::transaction(function () use ($response, $cartServices) {
             
                $transaction_id = $response['purchase_units'][0]['payments']['captures'][0]['id'];

                $payment = Payment::where('reference_number', $response['id'])->first(); 

                $order = Order::create([
                    'number' => $transaction_id,
                    'gross_total' => $payment->amount,
                    'tax_total' => 0,
                    'net_total' => 0,
                    'coupon_id' => null,
                    'coupon_amount' => 0,
                    'shipping_method_id' => $payment->shipping_method_id,
                    'shipping_charge' => $payment->shipping_amount,
                    'status' => 'confirmed',
                    'user_id' => auth()->user()->id,
                    'shipping_id' => auth()->user()->shipping()->id,
                    'billing_id' => auth()->user()->billing()->id,
                ]);

                $cart_items = $cartServices->getItems();

                foreach ($cart_items as $item) {

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'qty' => $item->qty,
                        'price' => $item->product->regular_price,
                        'properties' => $item->properties,
                    ]);

                }

                $cartServices->deleteItems();
             
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
