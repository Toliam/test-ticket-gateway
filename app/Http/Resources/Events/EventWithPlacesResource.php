<?php
declare(strict_types=1);

namespace App\Http\Resources\Events;

use App\Http\Resources\Places\PlacesResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="EventWithPlacesResource",
 *     type="object",
 *     title="Event resource",
 *     description="Events resource",
 *     required={
 *         "id",
 *         "date",
 *     },
 *
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="date",
 *         type="date",
 *         description="Date in format ISO 8601 (UTC)",
 *         example="2025-11-11T13:06:16+00:00"
 *     ),
 *     @OA\Property(
 *          property="places",
 *          type="array",
 *          description="Places",
 *
 *          @OA\Items(
 *              type="object",
 *              ref="#/components/schemas/PlacesResource"
 *          )
 *      )
 * )
 */
class EventWithPlacesResource extends EventResource
{
    public function toArray($request): array
    {
        $eventData = parent::toArray($request);

        $placesData = [
            'places' => PlacesResource::collection($this->whenLoaded('places')),
        ];

        return array_merge($eventData, $placesData);
    }
}
