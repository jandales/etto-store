<?php

namespace App\Http\Controllers\Users;

use Inertia\Inertia;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreAddressRequest;

class AddressController extends Controller
{
    public function index()
    {
        return Inertia::render('App/Accounts/Address/Index', [
            'addresses' => Address::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('App/Accounts/Address/Create');
    }

    public function store(StoreAddressRequest $request)
    {
        $validated =  $request->validated();
        $validated['user_id'] = auth()->user()->id;

        Address::create($validated);

        return redirect()->route('account.address')->with([
            'success' => true,
            'message' => 'Addresss Successfully Created'
        ]);
    }

    public function edit(Address $address)
    {

        return Inertia::render('App/Accounts/Address/Edit', [
            'address' => $address,
        ]);
    }

    public function update(StoreAddressRequest $request, Address $address)
    {
        $address->firstname = $request->firstname;
        $address->lastname = $request->lastname;
        $address->phone = $request->phone;
        $address->street = $request->street;
        $address->city = $request->city;
        $address->region = $request->region;
        $address->country =  $request->country;
        $address->zipcode = $request->zipcode;
        $address->save();

        return redirect()->route('account.address')->with([
            'success' => true,
            'message' => 'Addresss Successfully Updated',
        ]);
    }

    public function shipping(Address $address)
    {
        $user = auth()->user();
                $currentShipping = $user->shipping();

        if ($currentShipping)
        {
            $currentShipping->shipping = 0;
            $currentShipping->save();
        }
 

        $address->shipping = 1;
        $address->save();

        return redirect()->route('account.address')->with([
            'success' => true,
            'message' => 'Address Successfully Set Shipping'
        ]);
    }

    public function billing(Address $address)
    {
        $currentBilling = auth()->user()->billing();

        if($currentBilling){
            $currentBilling->billing = 0;
            $currentBilling->save();
        }

    

        $address->billing = 1;
        $address->save();

        return redirect()->route('account.address')->with([
            'success' => true,
            'message' => 'Address Successfully Set Billing'
        ]);
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route('account.address')->with([
            'success' => true,
            'message' => 'Address Successfully Deleted'
        ]);
    }
}
