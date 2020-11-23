<?php

namespace Gufo\Model;

use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherTest extends TestCase
{
    public function testConstructor()
    {
        $res = new Weather(56.16156, 15.58661);

        $this->assertInstanceOf(Weather::class, $res);
    }

    public function testGetHistory()
    {
        $weather = new Weather(56.16156, 15.58661);

        $res = $weather->getHistory();

        $this->assertInternalType("array", $res);
    }

    public function testGetForecast()
    {
        $weather = new Weather(56.16156, 15.58661);

        $res = $weather->getForecast();

        $this->assertInternalType("array", $res);
    }

    public function testGetAll()
    {
        $weather = new Weather(56.16156, 15.58661);

        $res = $weather->getAll();

        $this->assertInternalType("array", $res);
    }
}
