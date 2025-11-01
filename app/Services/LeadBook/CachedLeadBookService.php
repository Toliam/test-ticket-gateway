<?php
declare(strict_types=1);

namespace App\Services\LeadBook;

use App\Enums\CachePrefixEnum;
use App\Services\Events\Repositories\EventsRepositoryInterface;
use App\Services\LeadBook\DTO\JsonResponseDTO;
use App\Services\Places\Repositories\PlacesRepositoryInterface;
use App\Services\Shows\Repositories\ShowsRepositoryInterface;
use Illuminate\Support\Facades\Cache;

readonly class CachedLeadBookService extends LeadBookService implements
    ShowsRepositoryInterface,
    EventsRepositoryInterface,
    PlacesRepositoryInterface
{
    public function getShowsList(): JsonResponseDTO
    {
        return $this->getCachedOrFetch(
            CachePrefixEnum::SHOWS_LIST->value,
            fn() => parent::getShowsList()
        );
    }

    public function getEventsList(int $id): JsonResponseDTO
    {
        return $this->getCachedOrFetch(
            CachePrefixEnum::getEventListPrefix($id),
            fn() => parent::getEventsList($id)
        );
    }

    public function getPlacesList(int $eventId): JsonResponseDTO
    {
        return $this->getCachedOrFetch(
            CachePrefixEnum::getPlacesListPrefix($eventId),
            fn() => parent::getPlacesList($eventId)
        );
    }

    private function getCachedOrFetch(string $cacheKey, callable $fetchCallback): JsonResponseDTO
    {
        $cachedData = Cache::get($cacheKey);

        if ($cachedData !== null) {
            return new JsonResponseDTO($cachedData);
        }

        $result = $fetchCallback();
        Cache::put($cacheKey, $result->json, config('cache.ttl')); // ttl in seconds.

        return $result;
    }
}
