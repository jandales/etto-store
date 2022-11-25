<?php

namespace App\Http\Controllers\Web\App\Orders;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowOrderController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('App/Accounts/Orders/Details');
    }
}
