<?php

namespace vildanbina\GeoIP\Facades;

use Illuminate\Support\Facades\Facade;

class GeoIP extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'geoip';
    }
}