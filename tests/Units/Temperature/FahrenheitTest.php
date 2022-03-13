<?php

namespace Units\Temperature;

use Convert\Units\Temperature\Celsius;
use Convert\Units\Temperature\Fahrenheit;
use Convert\Units\Temperature\Kelvin;
use PHPUnit\Framework\TestCase;

class FahrenheitTest extends TestCase
{
    private Fahrenheit $fahrenheit;

    public function setUp(): void
    {
        $this->fahrenheit = new Fahrenheit();
    }

    public function testSelf(): void
    {
        $this->assertEquals(20, $this->fahrenheit->setvalue(20)->convert(new Fahrenheit()));
    }

    public function testCelsius(): void
    {
        $this->assertEquals(10, $this->fahrenheit->setvalue(50)->convert(new Celsius()));
        $this->assertEquals(40, $this->fahrenheit->setvalue(104)->convert(new Celsius()));
        $this->assertEquals(-20, $this->fahrenheit->setvalue(-4)->convert(new Celsius()));
    }

    public function testKelvin(): void
    {
        $this->assertEquals(273.15, $this->fahrenheit->setvalue(32)->convert(new Kelvin()));
        $this->assertEquals(310.928, $this->fahrenheit->setvalue(100)->convert(new Kelvin()));
        $this->assertEquals(262.039, $this->fahrenheit->setvalue(12)->convert(new Kelvin()));
    }
}
