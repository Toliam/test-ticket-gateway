<?php
declare(strict_types=1);

namespace App\Services\Shows;

use App\Models\Show;
use App\Services\Shows\Repositories\ShowsRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

readonly class ShowsService implements ShowsServiceInterface
{
    public function __construct(
        private ShowsRepositoryInterface $showsRepository,
    ) {
    }

    public function list(): Collection
    {
        $showsList = $this->showsRepository->getShowsList();

        return collect($showsList->json)->map(static fn(array $show): Show => new Show($show));
    }

    public function getPaginated(?int $page, int $perPage = 10): LengthAwarePaginator
    {
        $shows = $this->list();

        $currentPage = max($page ?? 1, 1);
        $offset = ($currentPage - 1) * $perPage;
        $items = array_slice($shows->all(), $offset, $perPage, true);

        return new LengthAwarePaginator($items, $shows->count(), $perPage, $currentPage, [
            'path' => route('shows.index')
        ]);
    }

    public function findShowWithEvents(int $id, Collection $events): Show
    {
        $show = $this->list()->firstOrFail('id', $id);

        return $show->setRelation('events', $events);
    }
}
