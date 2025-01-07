<?php

namespace App;

use App\Services\GeoLocation\GeoLocation;
use App\Services\GeoLocation\GeoLocationFacade;

class Playground {
    public function __construct(GeoLocation $geolocation)
    {
        $result = GeoLocationFacade::search('a');
        dump($result);
    }
}
?>