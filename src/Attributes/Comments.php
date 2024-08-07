<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Comments
{
    protected $comments;

    public function commentsIsValid(): bool
    {
        return is_string($this->comments) && strlen($this->comments) < 1024;
    }

    public function commentsIsRequired(): bool
    {
        return false;
    }
}
