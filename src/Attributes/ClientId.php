<?php declare(strict_types=1);

namespace PAN\Attributes;

trait ClientId
{
    protected $clientId;

    public function clientIdIsValid(): bool
    {
        return filter_var($this->clientId, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    public function clientIdIsRequired(): bool
    {
        return true;
    }
}
