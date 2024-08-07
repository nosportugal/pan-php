<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Fqdn
{
    protected $fqdn;

    public function fqdnIsValid(): bool
    {
        return is_string($this->fqdn) && preg_match('/^[a-zA-Z0-9_]([a-zA-Z0-9._-])+[a-zA-Z0-9]$/', $this->fqdn);
    }

    public function fqdnIsRequired(): bool
    {
        return true;
    }
}
