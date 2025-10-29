<?php
declare(strict_types=1);

namespace App\Http\DTO;

use Illuminate\Support\Collection;

readonly class ReservePlacesDTO
{
    public function __construct(
        public int        $eventId,
        public string     $name,
        public Collection $places,
    ) {
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromRequest(array $data): self
    {
        return new self(
            $data['eventId'],
            $data['name'],
            collect($data['places']),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'places' => $this->places->toArray(),
        ];
    }
}
