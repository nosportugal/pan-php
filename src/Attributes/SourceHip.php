<?php declare(strict_types=1);

namespace PAN\Attributes;

use PAN\Util;

trait SourceHip
{
    protected $sourceHip = ['any'];

    public function sourceHipIsValid(): bool
    {
        return Util::isArrayOfString($this->sourceHip);
    }

    public function sourceHipIsRequired(): bool
    {
        return false;
    }
}
