<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Name
{
    protected $name;

    public function nameIsValid(): bool
    {
        return is_string($this->name);
    }

    public function nameIsRequired(): bool
    {
        return true;
    }
}
