<?php

namespace Robin\Models;
use Anax\Response\ResponseUtility;
use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Testing the GeoTag Model
 */
class GeoTagModelTest extends TestCase
{   
    /**
     * Testing the test route
     */
    // public function testGetCurrentTemp()
    // {   
    //     // Setup
    //     $geoTag = new GeoTag();
    //     $geoTag->getCurrentWeather(60.85, 26.76);

    //     $res = $geoTag->getCurrentFeelsLike();
    //     $this->assertIsString($res);
    // }

    public function testGetCurrentFeelsLike()
    {   
        // Setup
        $geoTag = new GeoTag();
        $geoTag->getCurrentWeather(60.85, 26.76);

        $res = $geoTag->getCurrentFeelsLike();
        $this->assertIsFloat($res);
    }

    public function testgetCurrentWeatherMain()
    {
        // Setup
        $geoTag = new GeoTag();
        $geoTag->getCurrentWeather(60.85, 26.76);

        $res = $geoTag->getCurrentWeatherMain();
        $this->assertIsString($res);
    }

    public function testgetCurrentWindSpeed()
    {
        // Setup
        $geoTag = new GeoTag();
        $geoTag->getCurrentWeather(60.85, 26.76);

        $res = $geoTag->getCurrentWindSpeed();
        $this->assertIsFloat($res);
    }

    public function testgetWeather()
    {
        // Setup
        $geoTag = new GeoTag();
        $res = $geoTag->getWeather(60.85, 26.76);

        $this->assertIsArray($res);
    }

    public function testgetTemperature()
    {
        // Setup
        $geoTag = new GeoTag();
        $geoTag->getWeather(60.85, 26.76);
        $res = $geoTag->getTemperature();

        $this->assertIsArray($res);
    }

    public function testgetFeelsLike()
    {
        // Setup
        $geoTag = new GeoTag();
        $geoTag->getWeather(60.85, 26.76);
        $res = $geoTag->getFeelsLike();

        $this->assertIsArray($res);
    }

    public function testgetWeatherMain()
    {
        // Setup
        $geoTag = new GeoTag();
        $geoTag->getWeather(60.85, 26.76);
        $res = $geoTag->getWeatherMain();

        $this->assertIsArray($res);
    }

    public function testgetWindSpeed()
    {
        // Setup
        $geoTag = new GeoTag();
        $geoTag->getWeather(60.85, 26.76);
        $res = $geoTag->getWindSpeed();

        $this->assertIsArray($res);
    }

    public function testsetLatLongFromIp()
    {
        // Setup
        $geoTag = new GeoTag();
        $geoTag->setLatLongFromIp("93.106.206.157");
        $res = $geoTag->getLat();

        $this->assertIsFloat($res);

        $res = $geoTag->getLon();
        $this->assertIsFloat($res);
    }

}