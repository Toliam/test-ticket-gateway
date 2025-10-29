<?php
declare(strict_types=1);

namespace App\Services\LeadBook\DTO;

readonly class BadRequestDTO
{
    public function __construct(
        private int $code,
        private string $message,
    ) {
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
