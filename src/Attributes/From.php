<?php declare(strict_types=1);

namespace PAN\Attributes;

use PAN\Util;

trait From
{
    protected $from = ['trust'];

    public function fromIsValid(): bool
    {
        return Util::isArrayOfString($this->from);
    }

    public function fromIsRequired(): bool
    {
        return true;
    }
}
