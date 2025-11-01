<?php

namespace App\Exceptions;

use Exception;

class AvailabilityException extends Exception
{
    public function getStatusCode(): int
    {
        return $this->code;
    }
}
