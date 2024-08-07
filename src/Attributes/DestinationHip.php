<?php declare(strict_types=1);

namespace PAN\Attributes;

use PAN\Util;

trait DestinationHip
{
    protected $destinationHip = ['any'];

    public function destinationHipIsValid(): bool
    {
        return Util::isArrayOfString($this->destinationHip);
    }

    public function destinationHipIsRequired(): bool
    {
        return false;
    }
}
