<?php
namespace Convert\Command;

use Convert\Units\Temperature\AbstractTemperature;
use Convert\Units\Temperature\Celsius;
use Convert\Units\Temperature\Fahrenheit;
use Convert\Units\Temperature\Kelvin;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'temperature',
    description: 'Converts a given temperature',
    aliases: ['temp'],
    hidden: false
)]

 final class Temperature extends Command
{
    /** The name of the command */
    protected static $defaultName = 'temperature';
    /** An array of available units to use for Temperature */
    protected array $availableUnits = [
        'c' => Celsius::class,
        'f' => Fahrenheit::class,
        'k' => Kelvin::class,
    ];
    /** The default unit to use in shorthand */
    private const DEFAULT_UNIT = 'c';
    /** The default unit to convert to in shorthand */
    private const DEFAULT_TO = 'f';

    protected function configure(): void
    {
        $this->addArgument('value', InputArgument::REQUIRED, 'The value to convert');
        $this->addArgument(
            'unit',
            InputArgument::OPTIONAL,
            $this->getArgumentDescription(self::DEFAULT_UNIT),
            self::DEFAULT_UNIT
        );
        $this->addArgument(
            'to',
            InputArgument::OPTIONAL,
            $this->getArgumentDescription(self::DEFAULT_TO),
            self::DEFAULT_TO
        );

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $value = $input->getArgument('value');
        $unit = strtolower($input->getArgument('unit'));
        $to = strtolower($input->getArgument('to'));

        $classFrom = $this->availableUnits[$unit] ?? null;
        $classTo = $this->availableUnits[$to] ?? null;

        try {
            $output->writeln($this->getClass($classFrom, $value)
                ->convert($this->getClass($classTo)));
            return self::SUCCESS;
        } catch(InvalidArgumentException $exception) {
            $output->writeln($exception->getMessage());
            return self::INVALID;
        }

    }

    /**
     * Gets the class name of the unit shorthand
     *
     * @param string $className The name of the class to instantiate
     * @param float|int $value The value to use when instantiating the class
     * @return AbstractTemperature The unit class if valid. Or Invalid command code if not
     * @throws InvalidArgumentException If the provided unit is not valid
     */
    private function getClass(mixed $className, float|int $value = 0): AbstractTemperature
    {
        if (!class_exists($className) || is_null($className)) {
            Throw New InvalidArgumentException('Provided unit not available to convert');
        }
        return new $className($value);
    }

    /**
     * Provides a string to use as a Command argument description
     *
     * @param string $default The default values to use in the description
     * @return string A strong to use as a description
     */
    private function getArgumentDescription(string $default): string
    {
        $string = 'Options are: ';
        foreach ($this->availableUnits as $key => $unit) {
            $string .= sprintf('%s for %s, ', $key, $unit);
        }
        $string .= 'The default option is: ' . $default;
        return $string;
    }
}