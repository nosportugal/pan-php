<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Offset
{
    protected $offset;

    public function offsetIsValid(): bool
    {
        return is_int($this->offset) && $this->offset >= 0;
    }

    public function offsetIsRequired(): bool
    {
        return false;
    }
}
