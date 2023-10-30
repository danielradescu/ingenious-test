<?php

namespace App\Modules\Approval\Infrastructure\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const ROUTE_PREFIX = 'api/approval';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function (): void {
            Route::middleware('api')
                ->prefix(self::ROUTE_PREFIX)
                ->group(base_path('app/Modules/Approval/Infrastructure/Routes/api.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
