<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Payment;
use App\Action\OrderAction;
use Illuminate\Http\Request;
use App\Jobs\ProccessOrderMail;
use App\Services\Web\CartServices;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CheckoutRequest;
use App\Services\Web\CheckoutServices;

class TestController extends Controller
{
    public function __invoke(CheckoutRequest $request, CartServices $cartServices , OrderAction $action, CheckoutServices $checkoutServices)
    {    
    
        if ( $cartServices->getCartCount() == 0) return;  
        
        $user = User::where('email', $request->email)->first();

        if (!$user) {
          //create user and address
          $user = $checkoutServices->createUserAccount($request);  

        } 
      
      try {

        $stripe_payment = $user->charge(
            $request->amount,
            $request->payment_method_id,
        );

        $stripe_payment = $stripe_payment->asStripePaymentIntent();           

        $order = DB::transaction(function() use($request, $action, $user, $stripe_payment, $cartServices) {

                $amount = $stripe_payment->amount;

                $order = $action->createOrder(
                    customer_id: $user->id,
                    total: $amount,
                    discount: 0,
                    taxes: 0,
                    coupon_code: null,
                    shipping_id: $user->shipping()->id,
                    billing_id: $user->billing()->id,
                    status: 'confirmed',
                );          

                Payment::create([
                    'reference_number' => $stripe_payment->id,
                    'order_id' => $order->id,
                    'shipping_method_id' => $request->shipping_method['id'],
                    'shipping_amount' => $request->shipping_method['amount'],
                    'amount'   => $amount,
                    'provider' => 'stripe',
                    'status'   => 'paid',
                    'user_id'  => $user->id,
                ]);

                $cartServices->clearCart();                

                return $order;

        });
                
        dispatch(new ProccessOrderMail($order));        

        // return redirect()->route('checkout.completed', $order);
        return response()->json([
            'success' => true,            
            'url' => route('checkout.completed', $order),
        ]);
           
      } catch (\Throwable $th) {
        return $th;
      }

    }
}
