<?php
declare(strict_types=1);

namespace App\Services\Shows\Repositories;

use App\Services\LeadBook\DTO\JsonResponseDTO;

interface ShowsRepositoryInterface
{
    public function getShowsList(): JsonResponseDTO;
}
