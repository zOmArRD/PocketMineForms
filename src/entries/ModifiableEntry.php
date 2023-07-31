<?php

declare(strict_types=1);

namespace zomarrd\forms\entries;

use InvalidArgumentException;

interface ModifiableEntry
{

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param mixed $value
     *
     * @return void
     */
    public function setValue($value): void;

    /**
     * @param mixed $input
     *
     * @throws InvalidArgumentException
     */
    public function validateUserInput($input): void;
}
