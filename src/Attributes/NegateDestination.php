<?php declare(strict_types=1);

namespace PAN\Attributes;

trait NegateDestination
{
    protected $negateDestination;

    public function negateDestinationIsValid(): bool
    {
        return is_bool($this->negateDestination);
    }

    public function negateDestinationIsRequired(): bool
    {
        return false;
    }
}
