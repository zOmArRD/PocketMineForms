<?php

declare(strict_types=1);

namespace zomarrd\forms\types;

use JsonSerializable;

final class Icon implements JsonSerializable
{

    public const URL = "url";
    public const PATH = "path";

    private string $type;

    private string $data;

    public function __construct(string $type, string $data)
    {
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            "type" => $this->type,
            "data" => $this->data
        ];
    }
}
