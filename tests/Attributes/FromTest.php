<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\From;

class FromPackage
{
    use From;

    public function __construct($from)
    {
        $this->from = $from;
    }
}

class FromTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfFromIsValid($value, $expected): void {
        $attribute = new FromPackage($value);

        $isValid = $attribute->fromIsValid();

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
