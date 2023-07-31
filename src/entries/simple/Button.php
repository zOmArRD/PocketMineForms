<?php declare(strict_types=1);

namespace zomarrd\forms\entries\simple;

use zomarrd\forms\entries\FormEntry;
use zomarrd\forms\types\Icon;

final class Button implements FormEntry
{

    private string $title;

    private ?Icon $icon;

    public function __construct(string $title, ?Icon $icon = null)
    {
        $this->title = $title;
        $this->icon = $icon;
    }

    /**
     * @return array<string, string|Icon|null>
     */
    public function jsonSerialize(): array
    {
        return [
            "text" => $this->title,
            "image" => $this->icon
        ];
    }
}
