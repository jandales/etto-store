<?php 

namespace App\Services\Web;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Action\Payment as PaymentAction;


class PaymentServices {

    private $user;
    private $payment_method_id;
    private $stipe;

    public function init($user)
    {
        $this->user= $user;
        return $this;
    }

    public function paymentMethod($payment_method_id)
    {
        $this->payment_method_id = $payment_method_id;
        return $this;
    }

    public function pay($amount)
    {
        $this->stripe = $this->user->charge($amount, $this->payment_method_id);
        return $this;
    }

    public function getIntent()
    {
       return $this->stripe->asStripePaymentIntent();
    }


}