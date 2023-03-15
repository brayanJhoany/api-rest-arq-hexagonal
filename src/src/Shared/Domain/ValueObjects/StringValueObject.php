<?php

namespace Src\Shared\Domain\ValueObjects;

abstract class StringValueObject
{

    public function __construct(
        private string $value
    ) {
    }


    /**
     * value
     *
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}