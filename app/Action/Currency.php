<?php

namespace App\Action;

class Currency
{

    public static function format($value)
    {
        return '₱'. number_format($value, 2);

    }
   
}
