<?php declare(strict_types=1);

namespace PAN\Attributes;

use PAN\Util;

trait ProfileSetting
{
    protected $profileSetting;

    public function profileSettingIsValid(): bool
    {
        if (is_array($this->profileSetting) && array_key_exists('group', $this->profileSetting)) {
            return Util::isArrayOfString($this->profileSetting['group']);
        }

        return false;
    }

    public function profileSettingIsRequired(): bool
    {
        return false;
    }
}
