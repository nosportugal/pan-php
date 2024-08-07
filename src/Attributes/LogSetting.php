<?php declare(strict_types=1);

namespace PAN\Attributes;

trait LogSetting
{
    protected $logSetting;

    public function logSettingIsValid(): bool
    {
        return is_string($this->logSetting);
    }

    public function logSettingIsRequired(): bool
    {
        return false;
    }
}
