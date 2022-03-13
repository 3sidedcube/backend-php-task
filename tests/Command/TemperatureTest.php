<?php

namespace Command;

use Convert\Command\Temperature;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

class TemperatureTest extends TestCase
{
    private Temperature $temperature;
    private CommandTester $commandTester;

    public function setUp(): void
    {
        $this->temperature = new Temperature();
        $this->commandTester = new CommandTester($this->temperature);
    }

    public function testIsCommand(): void
    {
        self::assertInstanceOf(Command::class, $this->temperature);
    }

    public function testNoArguments(): void
    {
        $this->expectErrorMessage('Not enough arguments (missing: "value").');
        $this->commandTester->execute([]);
    }

    public function testDefaultUnit(): void
    {
        $this->commandTester->execute(['value' => 100]);
        $this->assertEquals(212 . PHP_EOL, $this->commandTester->getDisplay());
    }

    public function testCelsiusToKelvin(): void
    {
        $this->commandTester->execute(['value' => 100, 'unit' => 'c', 'to' => 'k']);
        $this->assertEquals(373.15 . PHP_EOL, $this->commandTester->getDisplay());
    }

    public function testFahrenheitToCelsius(): void
    {
        $this->commandTester->execute(['value' => 100, 'unit' => 'f', 'to' => 'c']);
        $this->assertEquals(37.778 . PHP_EOL, $this->commandTester->getDisplay());
    }

    public function testFahrenheitToKelvin(): void
    {
        $this->commandTester->execute(['value' => 100, 'unit' => 'f', 'to' => 'k']);
        $this->assertEquals(310.928 . PHP_EOL, $this->commandTester->getDisplay());
    }

    public function testKelvinToFahrenheit(): void
    {
        $this->commandTester->execute(['value' => 100, 'unit' => 'k', 'to' => 'f']);
        $this->assertEquals(-279.67 . PHP_EOL, $this->commandTester->getDisplay());
    }

    public function testKelvinToFa(): void
    {
        $this->commandTester->execute(['value' => 100, 'unit' => 'k', 'to' => 'c']);
        $this->assertEquals(-173.15 . PHP_EOL, $this->commandTester->getDisplay());
    }

    public function testIncorrectUnit(): void
    {
        $this->commandTester->execute(['value' => 100, 'unit' => 'c', 'to' => 'a']);
        $this->assertEquals(
            'Provided unit not available to convert' . PHP_EOL,
            $this->commandTester->getDisplay()
        );
    }
}
