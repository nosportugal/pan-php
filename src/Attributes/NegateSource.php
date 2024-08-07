<?php declare(strict_types=1);

namespace PAN\Attributes;

trait NegateSource
{
    protected $negateSource;

    public function negateSourceIsValid(): bool
    {
        return is_bool($this->negateSource);
    }

    public function negateSourceIsRequired(): bool
    {
        return false;
    }
}
