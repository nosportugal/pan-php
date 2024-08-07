<?php declare(strict_types=1);

namespace PAN\Attributes;

use PAN\Util;

trait Tag
{
    protected $tag;

    public function tagIsValid(): bool
    {
        return Util::isArrayOfString($this->tag);
    }

    public function tagIsRequired(): bool
    {
        return false;
    }
}
