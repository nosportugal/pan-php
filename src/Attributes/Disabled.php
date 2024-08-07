<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Disabled
{
    protected $disabled;

    public function disabledIsValid(): bool
    {
        return is_bool($this->disabled);
    }

    public function disabledIsRequired(): bool
    {
        return false;
    }
}
