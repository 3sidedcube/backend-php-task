<?php

namespace Units\Temperature;

use Convert\Units\Temperature\Celsius;
use Convert\Units\Temperature\Fahrenheit;
use Convert\Units\Temperature\Kelvin;
use PHPUnit\Framework\TestCase;

class KelvinTest extends TestCase
{
    private Kelvin $kelvin;

    public function setUp(): void
    {
        $this->kelvin = new Kelvin();
    }

    public function testSelf(): void
    {
        $this->assertEquals(12, $this->kelvin->setvalue(12)->convert(new Kelvin()));
    }

    public function testCelsius(): void
    {
        $this->assertEquals(-273.15, $this->kelvin->setvalue(0)->convert(new Celsius()));
        $this->assertEquals(-173.15, $this->kelvin->setvalue(100)->convert(new Celsius()));
        $this->assertEquals(-236.15, $this->kelvin->setvalue(37)->convert(new Celsius()));
    }

    public function testFahrenheit(): void
    {
        $this->assertEquals(-402.07, $this->kelvin->setvalue(32)->convert(new Fahrenheit()));
        $this->assertEquals(-279.67, $this->kelvin->setvalue(100)->convert(new Fahrenheit()));
        $this->assertEquals(-438.07, $this->kelvin->setvalue(12)->convert(new Fahrenheit()));
    }
}
