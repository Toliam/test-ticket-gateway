<?php

namespace App\Exceptions\Availability;

use App\Exceptions\AvailabilityException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class PlaceNotAvailableException extends AvailabilityException
{
    const MESSAGE = 'Place(s) %s not available.';

    protected $code = Response::HTTP_BAD_REQUEST;

    public function __construct(Collection $badPlaces)
    {
        $message = sprintf(self::MESSAGE, $badPlaces->implode(', '));

        parent::__construct($message, $this->code);
    }
}
