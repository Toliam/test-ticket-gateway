<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\Events\Repositories\EventsRepositoryInterface;
use App\Services\LeadBook\Api\LeadBookApiService;
use App\Services\LeadBook\Api\LeadBookApiServiceInterface;
use App\Services\LeadBook\CachedLeadBookService;
use App\Services\LeadBook\LeadBookService;
use App\Services\Places\Repositories\PlacesRepositoryInterface;
use App\Services\Shows\Repositories\ShowsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class LeadBookServiceProvider extends ServiceProvider
{
    public array $singletons = [
        LeadBookApiServiceInterface::class => LeadBookApiService::class,
        ShowsRepositoryInterface::class => CachedLeadBookService::class,
        EventsRepositoryInterface::class => CachedLeadBookService::class,
        PlacesRepositoryInterface::class => LeadBookService::class,
    ];

    public function register(): void
    {
        $this->app->when([LeadBookApiService::class])
            ->needs('$apiHost')
            ->give(config('services.lead_book.api_host'));

        $this->app->when([LeadBookApiService::class])
            ->needs('$apiKey')
            ->give(config('services.lead_book.auth_token'));
    }

    public function boot(): void
    {
    }
}
