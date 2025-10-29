<?php
declare(strict_types=1);

namespace App\Services\Shows;

use App\Models\Show;
use App\Services\Shows\Repositories\ShowsRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

readonly class ShowsService implements ShowsServiceInterface
{
    public function __construct(
        private ShowsRepositoryInterface $showsRepository,
    ) {
    }

    public function getPaginated(?int $page, int $perPage = 10): Paginator
    {
        $shows = $this->list();

        $currentPage = max($page ?? 1, 1);
        $offset = ($currentPage - 1) * $perPage;

        return new Paginator(
            items: array_slice($shows->all(), $offset, $perPage, true),
            perPage: $perPage,
            currentPage: $currentPage,
            options: ['path' => route('shows.index')],
        );
    }

    public function findShowWithEvents(int $id, Collection $events): Show
    {
        $show = $this->list()->firstOrFail('id', $id);

        return $show->setRelation('events', $events);
    }

    public function list(): Collection
    {
        $showsList = $this->showsRepository->getShowsList();

        return collect($showsList->json)->map(static fn(array $show): Show => new Show($show));
    }
}
