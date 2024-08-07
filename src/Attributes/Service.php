<?php declare(strict_types=1);

namespace PAN\Attributes;

use PAN\Util;

trait Service
{
    protected $service;

    public function serviceIsValid(): bool
    {
        return Util::isArrayOfString($this->service);
    }

    public function serviceIsRequired(): bool
    {
        return true;
    }
}
