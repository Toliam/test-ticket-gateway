<?php
declare(strict_types=1);

namespace App\Http\Resources\Events;

use App\Http\Resources\Places\PlacesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
