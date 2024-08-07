<?php declare(strict_types=1);

namespace PAN\Attributes;

use PAN\Util;

trait DestinationRule
{
    protected $destinationRule;

    public function destinationRuleIsValid(): bool
    {
        return is_string($this->destinationRule);
    }

    public function destinationRuleIsRequired(): bool
    {
        return false;
    }
}
