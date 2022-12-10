<?php

namespace App\Http\Controllers\Web\Payments\Paypal;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Jobs\ProccessOrderMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Action\Payment as PaypalPayment;
use App\Services\Web\CartServices;
use App\Services\Web\UserServices;




class PaymentSuccessController extends Controller
{
    public function __invoke(Request $request, PaypalPayment $paypal, CartServices $cartServices, UserServices $userServices)
    {   

        $response = $paypal->capturePaymentOrder($request['token']);     
     
        if (!isset($response)) return redirect()->route('paypal')->with([
            'error' => true,
            'message' => 'Something went wrong'
        ]);

        if (isset($response) && $response['status'] == 'COMPLETED') {

            $order = DB::transaction(function () use ($response, $cartServices) {           
              
             
                $purchase_unit = $response['purchase_units'];
                $transaction_id = $purchase_unit[0]['payments']['captures'][0]['id'];
                $shipping_address = $purchase_unit[0]['shipping']['address'];
                $name = explode(" ", $purchase_unit[0]['shipping']['name']['full_name']);

                $email = $response['payer']['email_address'];           
               

                $user = User::where('email',$email)->first();
                
                if (!$user) {
                                

                    $data = [
                        'email' => $email,
                        'firstname' =>  $response['payer']['name']['given_name'],
                        'lastname' =>  $response['payer']['name']['surname'],
                        'shipping_firstname' => $name[0],
                        'shipping_lastname' =>  $name[1],
                        'street' =>    $shipping_address['address_line_1'],
                        'city' =>      $shipping_address['admin_area_2'],
                        'region' =>    $shipping_address['admin_area_1'],
                        'zipcode' =>   $shipping_address['postal_code'],
                        'country' =>   $shipping_address['country_code'],
                        'phone' => 0241545454,
                        'billing' => true,
                        'shipping' => true,
                    ];

                    $userServices->checkoutNewUser($data);              
                    $userServices->userCreateAddress($user, $data);  
                              
                }           

                $payment = Payment::where('reference_number', $response['id'])->first();
                $payment->reference_number = $transaction_id;
                $payment->status = strtolower($response['status']);
                $payment->user_id = $user->id;
                $payment->save();  

                $order = Order::where('id', $payment->order_id)->first();
                $order->status = 'confirmed';
                $order->user_id = $user->id;   
                $order->billing_id = $user->billing()->id;
                $order->shipping_id = $user->shipping()->id;            
                $order->save();

                $cartServices->clearCart();
                
                dispatch(new ProccessOrderMail($order));
                
                return $order;

            });
      
            return redirect()->route('checkout.completed', $order);    

        }
    }
}
