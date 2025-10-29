<?php
declare(strict_types=1);

namespace App\Http\Resources\Events;

use App\Http\Resources\Places\PlacesResource;
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
 *         type="string",
 *         description="Date in format YYYY-MM-DD",
 *         example="2022-12-22"
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
class EventWithPlacesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'places' => PlacesResource::collection($this->whenLoaded('places')),
        ];
    }
}
