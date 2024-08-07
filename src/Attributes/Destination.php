<?php declare(strict_types=1);

namespace PAN\Attributes;

use PAN\Util;

trait Destination
{
    protected $destination;

    public function destinationIsValid(): bool
    {
        return Util::isArrayOfString($this->destination);
    }

    public function destinationIsRequired(): bool
    {
        return true;
    }
}
