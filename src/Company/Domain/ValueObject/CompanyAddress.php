<?php

namespace OptimaCultura\Company\Domain\ValueObject;

final class CompanyAddress
{
    private string $value;

    public function __construct(string $address)
    {
        $this->value = $address;
    }

    public function get(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
