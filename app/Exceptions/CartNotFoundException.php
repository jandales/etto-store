<?php

namespace App\Exceptions;

use Exception;

class CartNotFoundException extends Exception
{
     /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response([
            'errors' => [
                'message' => $this->getMessage(),
            ]
        ], $this->code);
    }
}
