<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\Events\EventsService;
use App\Services\Events\EventsServiceInterface;
use App\Services\Places\PlacesService;
use App\Services\Places\PlacesServiceInterface;
use App\Services\Shows\ShowsService;
use App\Services\Shows\ShowsServiceInterface;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $singletons = [
        ShowsServiceInterface::class => ShowsService::class,
        EventsServiceInterface::class => EventsService::class,
        PlacesServiceInterface::class => PlacesService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Limit API requests to 100 requests per second per user or IP address
        RateLimiter::for('api', function (Request $request) {
            return Limit::perSecond(100)->by($request->user()?->id ?: $request->ip());
        });

        // Route ID only digits
        Route::pattern('showId', '[0-9]+');
        Route::pattern('eventId', '[0-9]+');

        // Without wrapping for all resources
        JsonResource::withoutWrapping();
    }
}
