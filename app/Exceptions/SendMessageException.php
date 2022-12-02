<?php

namespace App\Exceptions;

use Exception;

class SendMessageException extends Exception
{
    public function render($request)
    {
        return response([
            'errors' => [
                'message' => $this->getMessage() ?? 'Message not sent, Please try again',
            ]
        ], $this->code ?? 500);
    }
}
