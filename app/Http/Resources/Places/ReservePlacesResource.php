<?php
declare(strict_types=1);

namespace App\Http\Resources\Places;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservePlacesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'success' => $this->success,
            'reservation_id' => $this->reservationId,
        ];
    }
}
