<?php

namespace App\Services\Web;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerServices {
    
    public function createUserAccountAndAddress($request)
    {
        $user = User::create([
            'email' => $request->email,
            'firstname' => $request->shipping['firstname'],
            'lastname'  => $request->shipping['lastname'],
            'password'  => Hash::make('password'),
        ]);

        if ( $request->same_as_shipping == false ) {

           $user->address()->create([
                 'firstname' => $request->billing['firstname'],
                'lastname' => $request->billing['lastname'],
                'phone' => $request->billing['firstname'],
                'street' => $request->billing['street'],
                'city' => $request->billing['city'],
                'region' => $request->billing['region'],
                'country' => $request->billing['country'],
                'zipcode' => $request->billing['postalCode'],
                'billing' => true,
                'shipping' => false,
            ]);
        }

        $user->address()->create([
            'firstname' => $request->shipping['firstname'],
            'lastname' => $request->shipping['lastname'],
            'phone' => $request->shipping['firstname'],
            'street' => $request->shipping['street'],
            'city' => $request->shipping['city'],
            'region' => $request->shipping['region'],
            'country' => $request->shipping['country'],
            'zipcode' => $request->shipping['postalCode'],
            'billing' => $request->same_as_shipping ? true : false,
            'shipping' => true,
        ]);

        return $user;
    }

  

}