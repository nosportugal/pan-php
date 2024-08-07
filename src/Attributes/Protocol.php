<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Protocol
{
    protected $protocol;

    public function protocolIsValid(): bool
    {
        if (is_array($this->protocol)) {
            if (array_key_exists('tcp', $this->protocol) xor array_key_exists('udp', $this->protocol)) {
                $type = (array_keys($this->protocol))[0];

                return array_key_exists('port', $this->protocol[$type]) && is_string($this->protocol[$type]['port']);
            }
        }

        return false;
    }

    public function protocolIsRequired(): bool
    {
        return true;
    }
}
