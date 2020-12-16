<?php

namespace Robin\Models;
use Anax\Response\ResponseUtility;
use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Testing the Covalidator Service
 */
class GeoTagIpTest extends TestCase
{   
    /**
     * Testing the test route
     */
    public function testGetIp()
    {   
        // Setup
        $geo = new GeoTagIp();
        $geo->setupGeoIp("93.106.159.184");

        $res = $geo->getIp();
        $this->assertContains("93.106.159.184", $res);
    }

    public function testGetType()
    {
        // Setup
        $geo = new GeoTagIp();
        $geo->setupGeoIp("93.106.206.157");

        $res = $geo->getType();
        $this->assertContains("ipv4", $res);
    }

    public function testGetCountry()
    {
        // Setup
        $geo = new GeoTagIp();
        $geo->setupGeoIp("93.106.206.157");

        $res = $geo->getCountry();
        $this->assertContains("Finland", $res);
    }

    public function testGetRegion()
    {
        // Setup
        $geo = new GeoTagIp();
        $geo->setupGeoIp("96.158.226.150");

        $res = $geo->getRegion();
        $this->assertContains("New York", $res);
    }

    public function testGetCity()
    {
        // Setup
        $geo = new GeoTagIp();
        $geo->setupGeoIp("96.158.226.150");

        $res = $geo->getCity();
        $this->assertContains("Manhattan", $res);
    }

    public function testGetLatitude()
    {
        // Setup
        $geo = new GeoTagIp();
        $geo->setupGeoIp("96.158.226.150");

        $res = $geo->getLatitude();
        $this->assertIsFloat($res);
    }

    public function testGetLongitude()
    {
        // Setup
        $geo = new GeoTagIp();
        $geo->setupGeoIp("96.158.226.150");

        $res = $geo->getLatitude();
        $this->assertIsFloat($res);
    }

}