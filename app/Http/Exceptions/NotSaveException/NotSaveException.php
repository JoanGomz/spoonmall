<?php

namespace App\Http\Exceptions\NotFoundException;

use Exception;

class NotSaveException extends Exception
{
    public function __construct($message = "Not Save", $code = 404, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
