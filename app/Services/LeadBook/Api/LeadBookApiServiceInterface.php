<?php
declare(strict_types=1);

namespace App\Services\LeadBook\Api;

use App\Http\DTO\ReservePlacesDTO;
use App\Services\LeadBook\DTO\JsonResponseDTO;

interface LeadBookApiServiceInterface
{
    public function fetchShows(): JsonResponseDTO;

    public function fetchEvents(int $id): JsonResponseDTO;

    public function fetchPlaces(int $eventId): JsonResponseDTO;

    public function storePlaces(ReservePlacesDTO $DTO): JsonResponseDTO;
}
