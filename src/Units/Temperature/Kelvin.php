<?php

namespace Convert\Units\Temperature;

class Kelvin extends AbstractTemperature
{
    /** @var float a constant value to add to Celsius */
    public const KELVIN_CELSIUS_ADD = 273.15;

    /**
     * {@inheritdoc}
     */
    public function convert(AbstractTemperature $convertTo): float
    {
        $return = match (true) {
            $convertTo instanceof self => $this->value,
            $convertTo instanceof Celsius => $this->value - self::KELVIN_CELSIUS_ADD,
            $convertTo instanceof Fahrenheit => ($this->value - self::KELVIN_CELSIUS_ADD) * (9/5) + 32,
        };
        return round($return , 3);
    }
}