<?php
declare(strict_types=1);

namespace App\Services\Places;

use App\Http\DTO\ReservePlacesDTO;
use App\Http\DTO\ReserveResponseDTO;
use Illuminate\Support\Collection;

interface PlacesServiceInterface
{
    public function getPlacesByEventId(int $eventId): Collection;

    public function reserve(ReservePlacesDTO $DTO): ReserveResponseDTO;
}
