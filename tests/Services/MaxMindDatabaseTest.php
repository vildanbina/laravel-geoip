<?php

namespace vildanbina\GeoIP\Tests\Services;

use vildanbina\GeoIP\Tests\TestCase;

class MaxMindDatabaseTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnConfigValue()
    {
        list($service, $config) = $this->getService();

        $this->assertEquals($service->config('database_path'), $config['database_path']);
    }

    /**
     * @test
     */
    public function shouldReturnValidLocation()
    {
        list($service, $config) = $this->getService();

        $location = $service->locate('81.2.69.142');

        $this->assertInstanceOf(\vildanbina\GeoIP\Location::class, $location);
        $this->assertEquals($location->ip, '81.2.69.142');
        $this->assertEquals($location->default, false);
    }

    /**
     * @test
     */
    public function shouldReturnInvalidLocation()
    {
        list($service, $config) = $this->getService();

        try {
            $location = $service->locate('1.1.1.1');
            $this->assertEquals($location->default, false);
        }
        catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            $this->assertEquals($e->getMessage(), 'The address 1.1.1.1 is not in the database.');
        }
    }

    protected function getService()
    {
        $config = $this->getConfig()['services']['maxmind_database'];

        $service = new $config['class']($config);

        return [$service, $config];
    }
}
