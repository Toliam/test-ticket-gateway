<?php
declare(strict_types=1);

namespace App\Http\Resources\Places;

use Illuminate\Http\Resources\Json\JsonResource;

class PlacesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'x' => $this->x,
            'y' => $this->y,
            'width' => $this->width,
            'height' => $this->height,
            'is_available' => $this->is_available,
        ];
    }
}
