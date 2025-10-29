<?php
declare(strict_types=1);

namespace App\Http\Resources\Shows;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
