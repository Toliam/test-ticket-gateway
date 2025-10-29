<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\DTO\ReservePlacesDTO;
use App\Http\Requests\ReserveEventRequest;
use App\Http\Resources\Places\ReservePlacesResource;
use App\Services\Places\PlacesServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservePlacesController extends Controller
{
    public function __construct(
        private readonly PlacesServiceInterface $placesService,
    ) {
    }

    /**
     * @param int $eventId
     * @param ReserveEventRequest $request
     * @return JsonResource
     */
    public function __invoke(int $eventId, ReserveEventRequest $request): JsonResource
    {
        return new ReservePlacesResource($this->placesService->reserve(
            ReservePlacesDTO::fromRequest(array_merge($request->validated(), compact('eventId')))
        ));
    }
}
