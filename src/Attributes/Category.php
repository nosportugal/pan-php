<?php declare(strict_types=1);

namespace PAN\Attributes;

use PAN\Util;

trait Category
{
    protected $category = ['any'];

    public function categoryIsValid(): bool
    {
        return Util::isArrayOfString($this->category);
    }

    public function categoryIsRequired(): bool
    {
        return true;
    }
}
