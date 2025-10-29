<?php
declare(strict_types=1);

namespace App\Services\Events;

use App\Http\DTO\ShowEventDTO;
use App\Models\Event;
use App\Services\Events\Repositories\EventsRepositoryInterface;
use Illuminate\Support\Collection;

readonly class EventsService implements EventsServiceInterface
{
    public function __construct(
        private EventsRepositoryInterface $eventsRepository,
    ) {
    }

    public function getByShowId(int $id): Collection
    {
        $events = $this->eventsRepository->getEventsList($id);

        return collect($events->json)->map(static fn($event) => new Event($event));
    }

    public function getByDtoWithPlaces(ShowEventDTO $DTO): Event
    {
        return $this->getByShowId($DTO->showId)
            ->firstOrFail('id', $DTO->eventId)
            ->setRelation('places', $DTO->places);
    }
}
