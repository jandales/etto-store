<?php

namespace App\Http\Controllers\Web\App;

use App\Action\CookieAction;
use App\Http\Controllers\Controller;
use App\Services\Web\CartServices;

class CookieController extends Controller
{
    public function __invoke(CookieAction $cookie, CartServices $services)
    {
        return $cookie->set($services);
    }
}
