<?php

namespace App\Http\Controllers\Web\Payments\Paypal;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentProccessController extends Controller
{
    public function __invoke(Request $request)
    {
         
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();

        $response = $provider->createOrder([            
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel'),
            ],                        
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => $request->currency,
                        "value" => $request->amount,
                    ]
                ]
            ]
        ]);
     

        if (isset($response['id']) && $response['id'] != null) {

            $id = $response['id'];             
            // redirect to approve href
            foreach ($response['links'] as $link) {

                if ($link['rel'] == 'approve') {

                    Payment::create([
                        'reference_number' => $id,
                        'shipping_method_id' => $request->shipping_method,
                        'shipping_amount' => $request->shipping_amount,
                        'amount'   => $request->amount,
                        'provider' => 'paypal',
                        'status'   => 'pending',
                        'user_id'  => auth()->user()->id,
                    ]);                        

                    return Redirect::away($link['href']);
                }
            }

            return redirect()            
                ->route('paypal')
                ->with('error', 'Something went wrong.');

        } else {

            return redirect()
                ->route('paypal')
                ->with('error', $response['message'] ?? 'Something went wrong.');

        }

    }
}