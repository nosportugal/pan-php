<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Name;

class NamePackage
{
    use Name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

class NameTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfNameIsValid($value, $expected): void {
        $attribute = new NamePackage($value);

        $isValid = $attribute->nameIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is string' => ['foo', true],
            'Should be valid when value is empty string' => ['', true],
            'Should be valid when value is numeric as string' => ['12345', true],
            'Should not be valid when value is numeric' => [12345, false],
            'Should not be valid when value is null' => [null, false],
            'Should not be valid when value is true' => [true, false],
            'Should not be valid when value is false' => [false, false],
            'Should not be valid when value is array' => [['foo', 'baz'], false],
            'Should not be valid when value is object' => [new \stdClass(), false],
        ];
    }
}
