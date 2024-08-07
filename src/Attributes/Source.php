<?php declare(strict_types=1);

namespace PAN\Attributes;

use PAN\Util;

trait Source
{
    protected $source = ['any'];

    public function sourceIsValid(): bool
    {
        return Util::isArrayOfString($this->source);
    }

    public function sourceIsRequired(): bool
    {
        return true;
    }
}
