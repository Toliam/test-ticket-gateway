<?php
declare(strict_types=1);

namespace App\Services\Shows;

use App\Models\Show;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ShowsServiceInterface
{
    public function list(): Collection;

    public function getPaginated(?int $page, int $perPage = 10): LengthAwarePaginator;

    public function findShowWithEvents(int $id, Collection $events): Show;
}
