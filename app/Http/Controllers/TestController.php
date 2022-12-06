<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Jobs\ProccessOrderMail;

class TestController extends Controller
{
    public function __invoke()
    {
       $user  = auth()->user();
       $payment = $user->charge(1000, 1);
       $payment->asStripePaymentIntent();
    }
}
