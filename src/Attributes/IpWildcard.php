<?php declare(strict_types=1);

namespace PAN\Attributes;

trait IpWildcard
{
    protected $ipWildcard;

    public function ipWildcardIsValid(): bool
    {
        return is_string($this->ipWildcard);
    }

    public function ipWildcardIsRequired(): bool
    {
        return true;
    }
}
