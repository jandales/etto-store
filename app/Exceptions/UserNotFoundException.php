<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function render($request)
    {
        return response([
            'errors' => [
                'message' => $this->getMessage(),
            ]
        ],$this->code);
    }
}
