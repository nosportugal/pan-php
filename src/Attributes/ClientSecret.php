<?php declare(strict_types=1);

namespace PAN\Attributes;

trait ClientSecret
{
    protected $clientSecret;

    public function clientSecretIsValid(): bool
    {

        return is_string($this->clientSecret)
            && preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i', $this->clientSecret);
    }

    public function clientSecretIsRequired(): bool
    {
        return true;
    }
}
