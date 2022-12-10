<?php

namespace App\Http\Controllers\Web\Payments\Paypal;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentCancelController extends Controller
{
    public function __invoke(Request $request)
    {
        DB::transaction(function() use ($request) {

            $payment = Payment::where('reference_number', $request->token)->first();
            $order   = Order::find($payment->order_id);
            $orderItems = $order->items;
            
            foreach ($orderItems as $item) {
                $item->delete();
            }

            $order->delete();
            $payment->delete();

        });       

        return redirect()->route('checkout')
            ->with('error', 'You have canceled the transaction.');
    }
}
