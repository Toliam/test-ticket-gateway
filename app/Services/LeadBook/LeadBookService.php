<?php
declare(strict_types=1);

namespace App\Services\LeadBook;

use App\Http\DTO\ReservePlacesDTO;
use App\Services\Events\Repositories\EventsRepositoryInterface;
use App\Services\LeadBook\Api\LeadBookApiServiceInterface;
use App\Services\LeadBook\DTO\JsonResponseDTO;
use App\Services\Places\Repositories\PlacesRepositoryInterface;
use App\Services\Shows\Repositories\ShowsRepositoryInterface;

readonly class LeadBookService implements
    ShowsRepositoryInterface,
    EventsRepositoryInterface,
    PlacesRepositoryInterface
{
    public function __construct(
        private LeadBookApiServiceInterface $leadBookApiService,
    ) {
    }

    public function getShowsList(): JsonResponseDTO
    {
        return $this->leadBookApiService->fetchShows();
    }

    public function getEventsList(int $id): JsonResponseDTO
    {
        return $this->leadBookApiService->fetchEvents($id);
    }

    public function getPlacesList(int $eventId): JsonResponseDTO
    {
        return $this->leadBookApiService->fetchPlaces($eventId);
    }

    public function reserve(ReservePlacesDTO $places): JsonResponseDTO
    {
        return $this->leadBookApiService->storePlaces($places);
    }
}
