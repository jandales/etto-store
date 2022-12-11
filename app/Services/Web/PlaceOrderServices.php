<?php

namespace App\Services\Web;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Action\Payments\CreatePayment;
use App\Action\Payment as PaymentAction;


class PlaceOrderServices
{   

    public function placeOrder($request, $user, $stripe) {

        $order = DB::transaction(function () use ($request, $user, $stripe) {

            $amount = $stripe->amount;

            $payment = CreatePayment::handle([
                'reference_number' => $stripe->id,
                'shipping_method_id' => $request->shipping_method['id'],
                'shipping_amount' => $request->shipping_method['amount'],
                'amount'   => $amount,
                'provider' => 'stripe',
                'status'   => 'paid',
                'user_id'  => $user->id,
            ]);
           

            $order = Order::create([
                'total' =>  $amount,
                'dicount' => $request->discount,
                'taxes' => $request->taxes,
                'coupon_code' => $request->coupon_code,
                'status' => 'confirmed',
                'user_id' => $user->id,
                'shipping_id' => $user->shipping()->id,
                'billing_id' => $user->shipping()->id,
                'payment_id' => $payment->id,
            ]);        

           
            return $order;
        });

        return $order;
    }


}
