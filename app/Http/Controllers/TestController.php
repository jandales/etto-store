<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Jobs\ProccessOrderMail;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {
    
      
        $user = User::firstOrCreate([
            'email' => $request->email,
        ],[
            'firstname' => $request->shipping['firstname'],
            'lastname'  => $request->shipping['lastname'],
            'password'  => Hash::make('password'),
        ]);    

   
       

      try {

            $stripe_payment = $user->charge(
                $request->amount,
                $request->payment_method_id,
            );

           $stripe_payment = $stripe_payment->asStripePaymentIntent();

            $payment = Payment::create([
                'reference_number' => $stripe_payment->id,
                'shipping_method_id' => $request->shipping_method['id'],
                'shipping_amount' => $request->shipping_method['amount'],
                'amount'   => $stripe_payment->amount,
                'provider' => 'stripe',
                'status'   => 'paid',
                'user_id'  => $user->id,
            ]);
            
            return $payment;









           
      } catch (\Throwable $th) {
        //throw $th;
      }

    }
}
