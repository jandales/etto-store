<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules['email'] = 'required';
        $rules['shipping_firstname'] = 'required';
        $rules['shipping_lastname']  = 'required';
        $rules['shipping_street'] = 'required';
        $rules['shipping_city'] = 'required';
        $rules['shipping_phone'] = 'required';
        $rules['shipping_country'] = 'required';
        $rules['shipping_region'] ='required';
        $rules['shipping_zipcode'] = 'required';

        if (isset($this->same_as_shipping) && $this->same_as_shipping == true) return $rules;
    
        $rules['billing_firstname'] = 'required';
        $rules['billing_lastname']  = 'required';
        $rules['billing_street'] = 'required';
        $rules['billing_city'] = 'required';
        $rules['billing_phone'] = 'required';
        $rules['billing_country'] = 'required';
        $rules['billing_region'] = 'required';
        $rules['billing_zipcode'] = 'required';                                        
        

        return $rules;
    }
}
