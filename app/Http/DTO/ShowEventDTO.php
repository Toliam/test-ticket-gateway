<?php
declare(strict_types=1);

namespace App\Http\DTO;

use Illuminate\Support\Collection;

readonly class ShowEventDTO
{
    public function __construct(
        public int $showId,
        public int $eventId,
        public Collection $places
    ) {
    }
}
