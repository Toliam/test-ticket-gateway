<?php
declare(strict_types=1);

namespace App\Services\LeadBook\DTO;

readonly class JsonResponseDTO
{
    public function __construct(public array $json)
    {
    }
}
