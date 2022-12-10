<?php

namespace  App\Action;

use App\Contract\Payment as IPayment;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class Payment implements IPayment
{
    private $provider;


    public function __construct()
    {
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
        $this->provider->getAccessToken();  
    }

    public function getProvider()
    {
        return $this->provider;
    }

    public function capturePaymentOrder($token)
    {  
        return $this->provider->capturePaymentOrder($token);
    }

    public function pay($amount)
    {           
        
        $response = $this->provider->createOrder([
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
