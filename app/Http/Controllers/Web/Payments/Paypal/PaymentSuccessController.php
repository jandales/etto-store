<?php

namespace App\Http\Controllers\Web\Payments\Paypal;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Jobs\ProccessOrderMail;
use App\Services\Web\CartServices;
use App\Services\Web\UserServices;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Web\ProccessPaymentServices;

class PaymentSuccessController extends Controller
{
    public function __invoke(Request $request, ProccessPaymentServices $proccessPaymentServices, CartServices $cartServices, UserServices $userServices)
    {   

        $response = $proccessPaymentServices->capturePaymentOrder($request->token);     
  
        if (!isset($response)) return redirect()->route('checkout')->with([
            'error' => true,
            'message' => 'Something went wrong'
        ]);

        if (isset($response) && $response['status'] == 'COMPLETED') {

            $order = DB::transaction(function () use ($response, $cartServices, $proccessPaymentServices, $userServices)  {         
                           
                $purchase_unit = $response['purchase_units'];
                $transaction_id = $purchase_unit[0]['payments']['captures'][0]['id'];
                $shipping_address = $purchase_unit[0]['shipping']['address'];
                $name = explode(" ", $purchase_unit[0]['shipping']['name']['full_name']);
                $payer = $response['payer'];
                $email = $payer['email_address'];  

                $user = User::where('email', $email)->first();
                
                if (!$user) {                                

                    $data = [
                        'email' => $email,
                        'firstname' =>  $payer['name']['given_name'],
                        'lastname' =>  $payer['name']['surname'],
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

                    $userServices->checkoutNewUser( data: $data );              
                    $userServices->userCreateAddress(
                        user : $user, 
                        data : $data
                    );  
                              
                }           
                            
                $payment = $proccessPaymentServices->updatePayment(
                    key : $response['id'], 
                    user_id : $user->id,
                    transaction_id : $transaction_id,
                    status : strtolower($response['status'])
                );

                $order = Order::create([                    
                    'total' => $payment->amount,
                    'discount' => 0,
                    'taxes' => 0,                    
                    'coupon_code' => null,
                    'status' => 'confirmed',
                    'user_id' => $user->id,
                    'payment_id' => $payment->id,
                    'shipping_id' => $user->shipping()->id,
                    'billing_id' => $user->billing()->id,
                ]);


                $cartServices->clearCart();
                
                dispatch(new ProccessOrderMail($order));
                
                return $order;

            });
      
            return redirect()->route('checkout.completed', $order);    

        }
    }
}
