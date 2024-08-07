<?php declare(strict_types=1);

namespace PAN\Attributes;

trait IpRange
{
    protected $ipRange;

    public function ipRangeIsValid(): bool
    {
        return is_string($this->ipRange);
    }

    public function ipRangeIsRequired(): bool
    {
        return true;
    }
}
