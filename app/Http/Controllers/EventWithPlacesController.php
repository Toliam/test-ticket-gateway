<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\DTO\ShowEventDTO;
use App\Http\Requests\ShowEventRequest;
use App\Http\Resources\Events\EventResource;
use App\Services\Events\EventsServiceInterface;
use App\Services\Places\PlacesServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class EventWithPlacesController extends Controller
{
    public function __construct(
        private readonly EventsServiceInterface $eventService,
        private readonly PlacesServiceInterface $placesService,
    ) {
    }

    /**
     * Without cache because places for booking should always be up to date.
     *
     * Pagination was skipped because I already do it in another service,
     *    but it is possible to add it here if needed.
     */
    public function __invoke(int $eventId, ShowEventRequest $request): JsonResource
    {
        $places = $this->placesService->getPlacesByEventId($eventId);

        return new EventResource($this->eventService->getByDtoWithPlaces(
            new ShowEventDTO($request->get('show_id'), $eventId, $places)
        ));
    }
}
