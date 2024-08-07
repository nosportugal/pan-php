<?php declare(strict_types=1);

namespace PAN\Attributes;

use PAN\Util;

trait To
{
    protected $to = ['trust'];

    public function toIsValid(): bool
    {
        return Util::isArrayOfString($this->to);
    }

    public function toIsRequired(): bool
    {
        return true;
    }
}
