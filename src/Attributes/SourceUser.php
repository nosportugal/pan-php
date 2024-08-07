<?php declare(strict_types=1);

namespace PAN\Attributes;

use PAN\Util;

trait SourceUser
{
    protected $sourceUser;

    public function sourceUserIsValid(): bool
    {
        return Util::isArrayOfString($this->sourceUser);
    }

    public function sourceUserIsRequired(): bool
    {
        return true;
    }
}
