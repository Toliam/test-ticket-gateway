<?php
declare(strict_types=1);

namespace App\Services\Events\Repositories;

use App\Services\LeadBook\DTO\JsonResponseDTO;

interface EventsRepositoryInterface
{
    public function getEventsList(int $id): JsonResponseDTO;
}
