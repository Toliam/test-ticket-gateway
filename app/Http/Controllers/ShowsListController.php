<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ShowListRequest;
use App\Http\Resources\Shows\ShowListCollection;
use App\Services\Shows\ShowsServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowsListController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/shows",
     *     tags={"Shows"},
     *     summary="Get shows list",
     *     description="This API endpoint returns a list of shows.",
     *
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         example=1,
     *
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ShowListCollection")
     *     ),
     *
     * )
     */
    public function __invoke(ShowsServiceInterface $showService, ShowListRequest $request): JsonResource
    {
        return new ShowListCollection($showService->getPaginated(
            $request->integer('page', 1)
        ));
    }
}
