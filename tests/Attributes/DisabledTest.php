<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Disabled;

class DisabledPackage
{
    use Disabled;

    public function __construct($disabled)
    {
        $this->disabled = $disabled;
    }
}

class DisabledTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfDisabledIsValid($value, $expected): void {
        $attribute = new DisabledPackage($value);

        $isValid = $attribute->disabledIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is boolean true' => [true, true],
            'Should be valid when value is boolean false' => [false, true],
            'Should not be valid when value is string' => ['foo', false],
            'Should not be valid when value is null' => [null, false],
            'Should not be valid when value is empty' => ['', false],
        ];
    }
}
