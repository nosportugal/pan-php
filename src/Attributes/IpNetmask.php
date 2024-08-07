<?php declare(strict_types=1);

namespace PAN\Attributes;

trait IpNetmask
{
    protected $ipNetmask;

    public function ipNetmaskIsValid(): bool
    {
        return is_string($this->ipNetmask);
    }

    public function ipNetmaskIsRequired(): bool
    {
        return true;
    }
}
