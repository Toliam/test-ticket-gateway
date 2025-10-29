<?php
declare(strict_types=1);

namespace App\Services\Events;

use App\Http\DTO\ShowEventDTO;
use App\Models\Event;
use Illuminate\Support\Collection;

interface EventsServiceInterface
{
    public function getByShowId(int $id): Collection;

    public function getByDtoWithPlaces(ShowEventDTO $DTO): Event;
}
