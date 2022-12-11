<?php

namespace  App\Action\Payments;

use App\Models\Payment;

class PaymentUpdate
{
    public static function handle(array $attributes, Payment $payment)
    {    

        $payment->update($attributes);
        return $payment;

    }

}
