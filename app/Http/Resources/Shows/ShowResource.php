<?php
declare(strict_types=1);

namespace App\Http\Resources\Shows;

use App\Http\Resources\Events\EventResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ShowResource",
 *     title="Show resource",
 *     description="Show resource",
 *
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Show id",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Title of the show",
 *         example="Show #1"
 *     ),
 *     @OA\Property(
 *         property="events",
 *         type="array",
 *         description="Events of the show",
 *         @OA\Items(
 *             type="object",
 *             ref="#/components/schemas/EventResource"
 *         )
 *     )
 * )
 */
class ShowResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'events' => EventResource::collection($this->whenLoaded('events')),
        ];
    }
}
