<?php

namespace  App\Action;

use App\Contract\Payment as IPayment;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class Payment implements IPayment
{
    public function pay($amount)
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
                        "currency_code" => 'PHP',
                        "value" => $amount,
                    ]
                ]
            ]
        ]);

        return $response;
    }
   
}
