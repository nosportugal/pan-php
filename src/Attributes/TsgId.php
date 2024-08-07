<?php declare(strict_types=1);

namespace PAN\Attributes;

trait TsgId
{
    protected $tsgId;

    public function tsgIdIsValid(): bool
    {
        return is_integer($this->tsgId);
    }

    public function tsgIdIsRequired(): bool
    {
        return true;
    }
}
