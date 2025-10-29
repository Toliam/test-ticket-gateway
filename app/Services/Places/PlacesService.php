<?php
declare(strict_types=1);

namespace App\Services\Places;

use App\Exceptions\Availability\PlaceNotAvailableException;
use App\Exceptions\Availability\PlaceNotFoundException;
use App\Http\DTO\ReservePlacesDTO;
use App\Http\DTO\ReserveResponseDTO;
use App\Models\Place;
use App\Services\Places\Repositories\PlacesRepositoryInterface;
use Illuminate\Support\Collection;

readonly class PlacesService implements PlacesServiceInterface
{
    public function __construct(
        private PlacesRepositoryInterface $repository,
    ) {
    }

    public function getPlacesByEventId(int $eventId): Collection
    {
        $places = $this->repository->getPlacesList($eventId);

        return collect($places->json)->map(static fn(array $place): Place => new Place($place));
    }

    public function reserve(ReservePlacesDTO $DTO): ReserveResponseDTO
    {
        $places = $this->getPlacesByEventId($DTO->eventId);

        $this->checkAvailability($places, $DTO);

        return ReserveResponseDTO::fromResponse($this->repository->reserve($DTO));
    }


    /**
     * Check the availability of places.
     *
     * Note: We will catch group AvailabilityException in bootstrap/app.php
     *
     * @throws PlaceNotAvailableException throws when places are not available.
     * @throws PlaceNotFoundException throws when places are not found.
     */
    private function checkAvailability(Collection $places, ReservePlacesDTO $DTO): void
    {
        $notFoundPlaces = $DTO->places->diff($places->pluck('id'));

        if ($notFoundPlaces->isNotEmpty()) {
            throw new PlaceNotFoundException($notFoundPlaces);
        }

        $notAvailablePlaces = $places->whereIn('id', $DTO->places)
            ->where('is_available', false);

        if ($notAvailablePlaces->isNotEmpty()) {
            throw new PlaceNotAvailableException($notAvailablePlaces->pluck('id'));
        }
    }
}
