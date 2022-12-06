<?php

namespace  App\Action;

use App\Services\Web\CartServices;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class CookieAction {

    public function set(CartServices $services)
    {
        if (Cookie::has('cart-id')) return true;

        $minutes = (60 * 24) * 7;
        $timestamp = Carbon::now()->timestamp;
        $value = $timestamp;
        $response = new Response('Hello World');
        $response->withCookie(cookie('cart-id', $value, $minutes));    

        $services->createCart($value);
        
        return $response;

    }
    
}