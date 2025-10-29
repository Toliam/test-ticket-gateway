<?php
declare(strict_types=1);

namespace App\Http\Resources\Shows;

use App\Http\Resources\Events\EventResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
