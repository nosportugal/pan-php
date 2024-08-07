<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Position
{
    protected $position;

    public function positionIsValid(): bool
    {
        return is_string($this->position) && in_array($this->position, $this->positionValues());
    }

    public function positionIsRequired(): bool
    {
        return true;
    }

    public function positionValues(): array
    {
        return ['pre', 'post'];
    }
}
