<?php

namespace Convert\Units\Temperature;

abstract class AbstractTemperature
{
    protected float $value;

    public function __construct(float $value = 0)
    {
        $this->setValue($value);
    }

    /**
     * @param int $value The value to set to a unit.
     * @return $this Fluid interface
     */
    public function setValue(int $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param AbstractTemperature $convertTo The unit to attempt to convert to
     * @return float The converted value
     */
    abstract public function convert(AbstractTemperature $convertTo): float;
}