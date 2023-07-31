<?php declare(strict_types=1);

namespace zomarrd\forms\entries\custom;

use InvalidArgumentException;
use zomarrd\forms\entries\ModifiableEntry;

final class ToggleEntry implements CustomFormEntry, ModifiableEntry
{

    private string $title;

    private bool $default;

    public function __construct(string $title, bool $default = false)
    {
        $this->title = $title;
        $this->default = $default;
    }

    public function getValue(): bool
    {
        return $this->default;
    }

    /**
     * @param bool $value
     *
     * @return void
     */
    public function setValue($value): void
    {
        $this->default = $value;
    }

    /**
     * @param $input mixed
     *
     * @return void
     */
    public function validateUserInput($input): void
    {
        if (!is_bool($input)) {
            throw new InvalidArgumentException("Failed to process invalid user input: " . $input);
        }
    }

    /**
     * @return array<string, string|bool>
     */
    public function jsonSerialize(): array
    {
        return [
            "type" => "toggle",
            "text" => $this->title,
            "default" => $this->default
        ];
    }
}
