<?php 

namespace App\Services\Web;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Action\Payment as PaymentAction;


class ProccessPaymentServices {

    private $proccessPayment;
    private $provider;
    private $response;

    public function __construct(PaymentAction  $proccessPayment)
    {
        $this->proccessPayment = $proccessPayment;
        $this->provider = 'paypal';
    }

    public function init($amount)
    {
        $this->response = $this->proccessPayment->pay($amount);     
        return $this;
    }

    public function capturePaymentOrder($token)
    {
        return $this->proccessPayment->capturePaymentOrder($token);  
    }

    public function getResponse()
    {
        return $this->response;
    }  

    public function getLinkApproved()
    {
        $response = $this->response;

        foreach ($response['links'] as $link) {
            if ($link['rel'] == 'approve') {
                return $link['href'];
            }
        }
    }

    public function getLinks()
    {
        $this->response['links'];
    }

    public function createPayment(array $data)
    {
        $response = $this->response;

        if (isset($response['id']) && $response['id'] != null) {

            DB::transaction(function () use ($data, $response) {                            

                Payment::create([
                    'reference_number' => $response['id'],                 
                    'shipping_method_id' => $data['shipping_method_id'],
                    'shipping_amount' => $data['shipping_amount'],
                    'amount'   =>  $data['amount'],
                    'provider' =>  $this->provider,
                    'status'   => 'pending',
                ]);
                
            });
        }

        return $this;
    } 
  

    public function updatePayment($key, $user_id, $transaction_id, $status)
    {
        $payment = Payment::where('reference_number', $key)->first();

        $payment->update([
            'reference_number' => $transaction_id,
            'status' => $status,
            'user_id' => $user_id,
        ]);  

        return $payment;
    }

}