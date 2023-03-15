<?php

namespace Src\Shared\Domain\ValueObjects;

abstract class MixedValueObject
{

    public function __construct(
        private mixed $value
    ) {
    }


    /**
     * value
     *
     * @return mixed
     */
    public function value(): mixed
    {
        return $this->value;
    }
}