<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Id
{
    protected $id;

    public function idIsValid(): bool
    {

        return is_string($this->id)
            && preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i', $this->id);
    }

    public function idIsRequired(): bool
    {
        return true;
    }
}
