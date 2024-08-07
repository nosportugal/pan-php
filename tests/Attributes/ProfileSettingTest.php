<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\ProfileSetting;

class ProfileSettingPackage
{
    use ProfileSetting;

    public function __construct($profileSetting)
    {
        $this->profileSetting = $profileSetting;
    }
}

class ProfileSettingTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfProfileSettingIsValid($value, $expected): void {
        $attribute = new ProfileSettingPackage($value);

        $isValid = $attribute->profileSettingIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is an array with group key name and value an array of string' => [['group' => ['Foo']], true],
            'Should not be valid when value is an array with group key name and value an array of number' => [['group' => [1]], false],
            'Should not be valid when value is an array with foo key name and value an array of string' => [['foo' => ['baz']], false],
        ];
    }
}
