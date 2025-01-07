<?php

namespace App\Services\GeoLocation;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array search(string $string)
 * @see GeoLocation
 */

class GeoLocationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return GeoLocation::class;
    }
}
