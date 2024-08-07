<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Description
{
    protected $description;

    public function descriptionIsValid(): bool
    {
        return is_string($this->description);
    }

    public function descriptionIsRequired(): bool
    {
        return false;
    }
}
