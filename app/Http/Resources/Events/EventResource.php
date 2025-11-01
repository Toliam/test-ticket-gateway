<?php
declare(strict_types=1);

namespace App\Http\Resources\Events;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="EventResource",
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
 *     )
 * )
 */
class EventResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'date' => Carbon::parse($this->date)->utc()->toIso8601String(),
        ];
    }
}
