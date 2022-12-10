<?php 

namespace App\Services\Web;

use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Action\Payment as PaymentAction;
use Illuminate\Support\Facades\Redirect;

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

    public function createOrder(array $data, OrderServices $orderServices)
    {
        $response = $this->response;

        if (isset($response['id']) && $response['id'] != null) {

            DB::transaction(function () use ($data, $response,  $orderServices) {

                $amount = $data['amount'];

                $order = $orderServices->createOrder([
                    'total' =>  $amount,
                    'discount' => $data['discount'],
                    'taxes' => $data['taxes'],
                    'status' => 'pending',
                    'cart_items' => $data['cart_items'],
                ]);

                Payment::create([
                    'reference_number' => $response['id'],
                    'order_id' => $order->id,
                    'shipping_method_id' => $data['shipping_method_id'],
                    'shipping_amount' => $data['shipping_amount'],
                    'amount'   =>  $amount,
                    'provider' =>  $this->provider,
                    'status'   => 'pending',
                ]);
                
            });
        }

        return $this;
    }


}