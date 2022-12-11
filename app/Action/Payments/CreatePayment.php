<?php

namespace  App\Action\Payments;

use App\Models\Payment;

class CreatePayment
{
    public static function handle(array $attributes)
    {
        return Payment::create($attributes);
    }
}
