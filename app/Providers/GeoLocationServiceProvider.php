<?php

namespace App\Providers;

use App\Services\GeoLocation\GeoLocation;
use App\Services\Map\Map;
use App\Services\Satellite\Satellite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class GeoLocationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * @return void
     */
    public function register(): void
    {
        //
        $this->app->bind(GeoLocation::class, function (Application $app) {
            $map = new Map();
            $satellite = new Satellite();

            return new GeoLocation($map, $satellite);
            // return "aaaa";
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
