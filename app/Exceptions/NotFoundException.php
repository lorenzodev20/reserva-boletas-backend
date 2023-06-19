<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function render($request)
    {
        return response()->json(['result' => false, 'message' => 'Customer not found'], 404);
    }
}
