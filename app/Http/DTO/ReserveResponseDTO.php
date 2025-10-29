<?php
declare(strict_types=1);

namespace App\Http\DTO;

use App\Services\LeadBook\DTO\JsonResponseDTO;

readonly class ReserveResponseDTO
{
    public function __construct(
        public bool   $success,
        public string $reservationId,
    ) {
    }

    /**
     * @param JsonResponseDTO $response
     * @return self
     */
    public static function fromResponse(JsonResponseDTO $response): self
    {
        $attributes = $response->json;

        return new self($attributes['success'], $attributes['reservation_id']);
    }
}
