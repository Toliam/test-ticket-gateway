<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\DTO\ShowEventDTO;
use App\Http\Requests\ShowEventRequest;
use App\Http\Resources\Events\EventWithPlacesResource;
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
     * @OA\Get(
     *     path="/api/events/{eventId}",
     *     tags={"Events"},
     *     summary="Get Event with Places",
     *     description="Get Event with Places.",
     *
     *     @OA\Parameter(
     *         name="eventId",
     *         in="path",
     *         description="Event id",
     *         required=true,
     *         example=1,
     *
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *
     *     @OA\Parameter(
     *         name="show_id",
     *         in="query",
     *         description="Show id",
     *         required=true,
     *         example=123,
     *
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *
     *         @OA\JsonContent(ref="#/components/schemas/EventWithPlacesResource")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Item Not Found",
     *     )
     * )
     */
    public function __invoke(int $eventId, ShowEventRequest $request): JsonResource
    {
        // todo: without pagination because I do it in another place
        // todo: we can't cache this because we want to have actual places for booking.
        $places = $this->placesService->getPlacesByEventId($eventId);

        return new EventWithPlacesResource($this->eventService->getByDtoWithPlaces(
            new ShowEventDTO($request->integer('show_id'), $eventId, $places)
        ));
    }
}
