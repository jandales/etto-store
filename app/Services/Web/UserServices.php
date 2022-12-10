<?php

namespace App\Services\Web;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserServices 
{
    public function checkoutNewUser(array $data)
    {
        return User::create([
            'email' =>$data['email'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'password' => Hash::make('password'),
        ]);
    }

    public function userCreateAddress(User $user, $data)
    {
        $user->address()->create([
            'firstname' =>  $data['shipping_firstname'],
            'lastname'  =>  $data['shippping_firstname'],
            'street'    =>  $data['street'],
            'city'      =>  $data['city'],
            'region'    =>  $data['region'],
            'zipcode'   =>  $data['zipcode'],
            'country'   =>  $data['country'],
            'phone'     =>  $data['phone'],
            'billing'   =>  $data['billing'],
            'shipping'  =>  $data['shipping'],
        ]);  
    }


}

