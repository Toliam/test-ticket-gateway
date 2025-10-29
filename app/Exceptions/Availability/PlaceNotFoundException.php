<?php

namespace App\Exceptions\Availability;

use App\Exceptions\AvailabilityException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class PlaceNotFoundException extends AvailabilityException
{
    const MESSAGE = 'Place(s) %s not found.';

    protected $code = Response::HTTP_NOT_FOUND;

    public function __construct(Collection $badPlaces)
    {
        $message = sprintf(self::MESSAGE, $badPlaces->implode(', '));

        parent::__construct($message, $this->code);
    }
}
