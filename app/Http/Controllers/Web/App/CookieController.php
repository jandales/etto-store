<?php

namespace App\Http\Controllers\Web\App;

use App\Action\CookieAction;
use App\Http\Controllers\Controller;
use App\Services\Web\CartServices;

class CookieController extends Controller
{
    public function __invoke(CartServices $services)
    {
        return CookieAction::handle($services);
    }
}
