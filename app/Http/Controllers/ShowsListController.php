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
     * @param ShowsServiceInterface $showService
     * @param ShowListRequest $request
     * @return JsonResource
     */
    public function __invoke(ShowsServiceInterface $showService, ShowListRequest $request): JsonResource
    {
        return new ShowListCollection($showService->getPaginated(
            $request->query('page')
        ));
    }
}
