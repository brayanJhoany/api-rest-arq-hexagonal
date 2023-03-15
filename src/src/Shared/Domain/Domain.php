<?php

namespace Src\Shared\Domain;

abstract class Domain
{
    public function __construct(
        private mixed $entity = null,
        private readonly ?string $exeption = null,

    ) {
        $this->isExeption($this->exeption);
    }
    public function entity(): mixed
    {
        return $this->entity();
    }
    protected abstract function isExeption(?string $exeption): void;
}