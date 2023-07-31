<?php declare(strict_types=1);

namespace zomarrd\forms\entries\custom;

use InvalidArgumentException;
use zomarrd\forms\entries\ModifiableEntry;

final class InputEntry implements CustomFormEntry, ModifiableEntry
{

    private string $title;

    private ?string $placeholder;

    private ?string $default;

    public function __construct(string $title, ?string $placeholder = null, ?string $default = null)
    {
        $this->title = $title;
        $this->placeholder = $placeholder;
        $this->default = $default;
    }

    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    public function getDefault(): ?string
    {
        return $this->default;
    }

    public function getValue(): ?string
    {
        return $this->default;
    }

    /**
     * @param string $value
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
        if (!is_string($input)) {
            throw new InvalidArgumentException("Failed to process invalid user input: " . $input);
        }
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            "type" => "input",
            "text" => $this->title,
            "placeholder" => $this->placeholder ?? "",
            "default" => $this->default ?? ""
        ];
    }
}
