<?php

namespace App\Services\GeoLocation;

use App\Services\Map\Map;
use App\Services\Satellite\Satellite;

class GeoLocation
{
    /**
     * @var Map;
     */
    private $map;

    /**
     * @var Satellite;
     */
    private $satellite;

    public function __construct(Map $map, Satellite $satellite)
    {
        $this->map = $map;
        $this->satellite = $satellite;
    }

    public function search(string $name)
    {
        // ...
        $locationInfo = $this->map->findAddress($name);
        
        $coordinates = $this->satellite->pinpoint($locationInfo);

        return $coordinates;
    }
}