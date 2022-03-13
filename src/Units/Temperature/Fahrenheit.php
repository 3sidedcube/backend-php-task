<?php

namespace Convert\Units\Temperature;

class Fahrenheit extends AbstractTemperature
{

    /**
     * {@inheritdoc}
     */
    public function convert(AbstractTemperature $convertTo): float
    {
        $return = match (true) {
            $convertTo instanceof self => $this->value,
            $convertTo instanceof Celsius => ($this->value - 32) / 1.8,
            $convertTo instanceof Kelvin => (($this->value - 32) / 1.8) + Kelvin::KELVIN_CELSIUS_ADD,
        };
        return round($return , 3);
    }
}