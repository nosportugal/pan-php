<?php declare(strict_types=1);

namespace PAN\Attributes;

use PAN\Util;

trait Application
{
    protected $application = ['any'];

    public function applicationIsValid(): bool
    {
        return Util::isArrayOfString($this->application);
    }

    public function applicationIsRequired(): bool
    {
        return true;
    }
}
