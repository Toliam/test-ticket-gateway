<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\Shows\ShowResource;
use App\Services\Events\EventsServiceInterface;
use App\Services\Shows\ShowsServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowWithEventsController extends Controller
{
    public function __construct(
        private readonly ShowsServiceInterface $showService,
        private readonly EventsServiceInterface $eventService,
    ) {
    }

    /**
     * @param int $showId
     * @return JsonResource
     */
    public function __invoke(int $showId): JsonResource
    {
        $events = $this->eventService->getByShowId($showId);

        return new ShowResource($this->showService->findShowWithEvents($showId, $events));
    }
}
