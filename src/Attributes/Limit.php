<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Limit
{
    protected $limit;

    public function limitIsValid(): bool
    {
        return is_int($this->limit) && $this->limit > 0;
    }

    public function limitIsRequired(): bool
    {
        return false;
    }
}
