<?php

namespace App\Http\Controllers\Web\Payments\Paypal;

use App\Http\Controllers\Controller;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;

class PaymentCancelController extends Controller
{
    public function __invoke()
    {
        return redirect()->route('paypal')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
