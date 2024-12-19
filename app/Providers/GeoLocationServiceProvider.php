<?php

namespace App\Providers;

use App\Services\GeoLocation\GeoLocation;
use App\Services\Map\Map;
use App\Services\Satellite\Satellite;
use Illuminate\Support\ServiceProvider;

class GeoLocationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * @return void
     */
    public function register(): void
    {
        //
        $this->app->bind(GeoLocation::class, function () {
            $map = new Map();
            $satellite = new Satellite();

            return new GeoLocation($map, $satellite);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
