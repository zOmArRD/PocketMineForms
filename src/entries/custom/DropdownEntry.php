<?php declare(strict_types=1);

namespace zomarrd\forms\entries\custom;

use InvalidArgumentException;
use zomarrd\forms\entries\ModifiableEntry;

final class DropdownEntry implements CustomFormEntry, ModifiableEntry
{
    private string $title;

    /**
     * @var array<int, string>
     */
    private array $options;

    private int $default = 0;

    /**
     * @param string $title
     * @param array<int, string> $options
     */
    public function __construct(string $title, array $options)
    {
        $this->title = $title;
        $this->options = array_values($options);
    }

    public function getValue(): string
    {
        return $this->options[$this->default];
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

    public function setDefault(string $default_option): void
    {
        foreach ($this->options as $index => $option) {
            if ($option === $default_option) {
                $this->default = $index;
                return;
            }
        }

        throw new InvalidArgumentException("Option \"" . $default_option . "\" does not exist!");
    }

    /**
     * @param $input mixed
     *
     * @return void
     */
    public function validateUserInput($input): void
    {
        if (!is_int($input) || !isset($this->options[$input])) {
            throw new InvalidArgumentException("Failed to process invalid user input: " . $input);
        }
    }

    /**
     * @return array<string, array<int, string>|int|string>
     */
    public function jsonSerialize(): array
    {
        return [
            "type" => "dropdown",
            "text" => $this->title,
            "options" => $this->options,
            "default" => $this->default
        ];
    }
}
