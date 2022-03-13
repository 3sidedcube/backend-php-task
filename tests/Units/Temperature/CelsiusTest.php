<?php

namespace Units\Temperature;

use Convert\Units\Temperature\Celsius;
use Convert\Units\Temperature\Fahrenheit;
use Convert\Units\Temperature\Kelvin;
use PHPUnit\Framework\TestCase;

class CelsiusTest extends TestCase
{
    private Celsius $celsius;

    public function setUp(): void
    {
        $this->celsius = new Celsius();
    }

    public function testSelf(): void
    {
        $this->assertEquals(100, $this->celsius->setvalue(100)->convert(new Celsius()));
    }

    public function testFahrenheit(): void
    {
        $this->assertEquals(212, $this->celsius->setvalue(100)->convert(new Fahrenheit()));
        $this->assertEquals(98.6, $this->celsius->setvalue(37)->convert(new Fahrenheit()));
        $this->assertEquals(32, $this->celsius->setvalue(0)->convert(new Fahrenheit()));
    }

    public function testKelvin(): void
    {
        $this->assertEquals(373.15, $this->celsius->setvalue(100)->convert(new Kelvin()));
        $this->assertEquals(310.15, $this->celsius->setvalue(37)->convert(new Kelvin()));
        $this->assertEquals(273.15, $this->celsius->setvalue(0)->convert(new Kelvin()));
    }
}
