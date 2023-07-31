<?php declare(strict_types=1);

namespace zomarrd\forms\entries\custom;

use ArgumentCountError;
use InvalidArgumentException;
use zomarrd\forms\entries\ModifiableEntry;

final class StepSliderEntry implements CustomFormEntry, ModifiableEntry
{

    private string $title;

    /**
     * @var array<int, string>
     */
    private array $steps;

    private int $default = 0;

    /**
     * @param string $title
     * @param array<int, string> $steps
     */
    public function __construct(string $title, array $steps)
    {
        $this->title = $title;
        $this->steps = array_values($steps);
    }

    public function getValue(): string
    {
        return $this->steps[$this->default];
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function setValue($value): void
    {
        $this->setDefault($value);
    }

    public function setDefault(string $default_step): void
    {
        foreach ($this->steps as $index => $step) {
            if ($step === $default_step) {
                $this->default = $index;
                return;
            }
        }

        throw new ArgumentCountError("Step \"" . $default_step . "\" does not exist!");
    }

    /**
     * @param $input mixed
     *
     * @return void
     */
    public function validateUserInput($input): void
    {
        if (!is_int($input) || $input < 0 || $input >= count($this->steps)) {
            throw new InvalidArgumentException("Failed to process invalid user input: " . $input);
        }
    }

    /**
     * @return array<string, array<int, string>|int|string>
     */
    public function jsonSerialize(): array
    {
        return [
            "type" => "step_slider",
            "text" => $this->title,
            "steps" => $this->steps,
            "default" => $this->default
        ];
    }
}
