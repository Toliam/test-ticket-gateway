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
     * @OA\Get(
     *     path="/api/shows/{showId}",
     *     tags={"Shows"},
     *     summary="Get Show with Events",
     *     description="Get Show with Events.",
     *
     *     @OA\Parameter(
     *         name="showId",
     *         in="path",
     *         description="Show id",
     *         required=true,
     *         example=1,
     *
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ShowResource")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     *
     * )
     */
    public function __invoke(int $showId): JsonResource
    {
        $events = $this->eventService->getByShowId($showId);

        return new ShowResource($this->showService->findShowWithEvents($showId, $events));
    }
}
