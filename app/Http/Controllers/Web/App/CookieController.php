<?php

namespace App\Http\Controllers\Web\App;

use App\Action\CookieAction;
use App\Http\Controllers\Controller;

class CookieController extends Controller
{
    public function __invoke(CookieAction $cookie)
    {
        return $cookie->set();
    }
}
