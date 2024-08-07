<?php declare(strict_types=1);

namespace PAN\Attributes;

trait baseUri
{
    protected $baseUri;

    public function baseUriIsValid(): bool
    {
        return filter_var($this->baseUri, FILTER_VALIDATE_URL) ? true : false;
    }

    public function baseUriIsRequired(): bool
    {
        return true;
    }
}
