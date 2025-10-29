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
     * @OA\Post(
     *     path="/api/events/{eventId}",
     *     tags={"Events"},
     *     summary="Reserve Event with Places",
     *     description="Reserve Event with Places.",
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
     *     @OA\RequestBody(
     *         required=true,
     *         description="Name and places for reservation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ReserveEventRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ReservePlacesResource")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Item Not Found",
     *     )
     * )
     */
    public function __invoke(int $eventId, ReserveEventRequest $request): JsonResource
    {
        return new ReservePlacesResource($this->placesService->reserve(
            ReservePlacesDTO::fromRequest(array_merge($request->validated(), compact('eventId')))
        ));
    }
}
