<?php
declare(strict_types=1);

namespace App\Services\Shows;

use App\Models\Show;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

interface ShowsServiceInterface
{
    public function list(): Collection;

    public function getPaginated(?int $page, int $perPage = 10): Paginator;

    public function findShowWithEvents(int $id, Collection $events): Show;
}
