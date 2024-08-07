<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\To;

class ToPackage
{
    use To;

    public function __construct($to)
    {
        $this->to = $to;
    }
}

class ToTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfToIsValid($value, $expected): void {
        $attribute = new ToPackage($value);

        $isValid = $attribute->toIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is an array of string' => [['foo', 'baz'], true],
            'Should not be valid when value not is an array of string' => [[1, null, true], false],
            'Should not be valid when value is an array empty' => [[], false],
        ];
    }
}
