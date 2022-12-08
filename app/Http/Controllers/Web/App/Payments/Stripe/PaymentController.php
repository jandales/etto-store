<?php

namespace App\Http\Controllers\Web\App\Payments\Stripe;

use Exeption;
use App\Models\User;
use App\Models\Payment;
use App\Action\OrderAction;
use App\Jobs\ProccessOrderMail;
use App\Services\Web\CartServices;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Services\Web\CheckoutServices;

class PaymentController extends Controller
{
    public function __invoke(CheckoutRequest $request, CartServices $cartServices,  CheckoutServices $checkoutServices)
    {

        if ($cartServices->getCartCount() == 0) return;

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            //create user and address
            $user = $checkoutServices->createUserAccount($request);
        }     

        $stripe_payment = $user->charge(
            $request->amount,
            $request->payment_method_id,
        );

        $stripe_payment = $stripe_payment->asStripePaymentIntent();

        $order = DB::transaction(function () use ($request, $checkoutServices, $user, $stripe_payment) {

            $amount = $stripe_payment->amount;

            $order = $checkoutServices->createOrder(
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

            return $order;
            
        });

        if($order) {
            //send email
            dispatch(new ProccessOrderMail($order));
        }
     
    
        return response()->json([
            'success' => true,
            'url' => route('checkout.completed', $order),
        ]);
    
    }
}
