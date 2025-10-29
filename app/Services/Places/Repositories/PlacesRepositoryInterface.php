<?php
declare(strict_types=1);

namespace App\Services\Places\Repositories;

use App\Http\DTO\ReservePlacesDTO;
use App\Services\LeadBook\DTO\JsonResponseDTO;

interface PlacesRepositoryInterface
{
    public function getPlacesList(int $eventId): JsonResponseDTO;

    public function reserve(ReservePlacesDTO $places): JsonResponseDTO;
}
