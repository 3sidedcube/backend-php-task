<?php

namespace Convert\Units\Temperature;

class Celsius extends AbstractTemperature
{

    /**
     * {@inheritdoc}
     */
    public function convert(AbstractTemperature $convertTo): float
    {
        $return = match (true) {
            $convertTo instanceof self => $this->value,
            $convertTo instanceof Fahrenheit => ($this->value * 1.8) + 32,
            $convertTo instanceof Kelvin => $this->value + Kelvin::KELVIN_CELSIUS_ADD,
        };
        return round($return , 3);
    }
}