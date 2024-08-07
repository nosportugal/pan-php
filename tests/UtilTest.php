<?php declare(strict_types=1);

namespace PAN\Tests;

use PHPUnit\Framework\TestCase;
use PAN\Util;

class UtilTest extends TestCase
{
    /**
     * @dataProvider camelToSnakeProvider
     */
    public function testCamelToSnake($value, $expected): void
    {
        $result = Util::camelToSnake($value);

        $this->assertEquals($result, $expected);
    }

    public static function camelToSnakeProvider(): array
    {
        return [
            'Should be valid when value from fooBarBaz to foo_bar_baz' => ['fooBarBaz', 'foo_bar_baz'],
            'Should be valid when value from BarBazFoo to bar_baz_foo' => ['BarBazFoo', 'bar_baz_foo'],
            'Should be valid when value from foo_bar_baz to foo_bar_baz' => ['foo_bar_baz', 'foo_bar_baz'],
            'Should be valid when value from bar_baz_foo to bar_baz_foo' => ['bar_baz_foo', 'bar_baz_foo'],
        ];
    }

    /**
     * @dataProvider snakeToCamelProvider
     */
    public function testSnakeToCamel($value, $expected, bool $capitalizeFirstCharacter = false): void
    {
        $result = Util::snakeToCamel($value, $capitalizeFirstCharacter);

        $this->assertEquals($result, $expected);
    }

    public static function snakeToCamelProvider(): array
    {
        return [
            'Should be valid when value from foo_bar_baz to fooBarBaz' => ['foo_bar_baz', 'fooBarBaz'],
            'Should be valid when value from bar_baz_foo to barBazFoo' => ['bar_baz_foo', 'barBazFoo'],
            'Should be valid when value from foo_bar_baz to FooBarBaz' => ['foo_bar_baz', 'FooBarBaz', true],
            'Should be valid when value from bar_baz_foo to BarBazFoo' => ['bar_baz_foo', 'BarBazFoo', true],
            'Should be valid when value from fooBarBaz to fooBarBaz' => ['fooBarBaz', 'fooBarBaz'],
            'Should be valid when value from barBazFoo to barBazFoo' => ['barBazFoo', 'barBazFoo'],
        ];
    }

    /**
     * @dataProvider headersProvider
     */
    public function testHeaders($value, $expected): void
    {
        $result = Util::headers($value);

        $this->assertEqualsCanonicalizing($result, $expected);
    }

    public static function headersProvider(): array
    {
        return [
            'Should be valid when value from ["bearer" => "Foo"] to ["Authorization" => "Bearer Foo"]' => [
                ['bearer' => 'Foo'], ['Authorization' => 'Bearer Foo']
            ],
            'Should be valid when value from ["content-type" => "Baz"] to ["Content-Type" => "Baz"]' => [
                ['content-type' => 'Baz'], ['Content-Type' => 'Baz']
            ],
        ];
    }

    /**
     * @dataProvider isArrayOfStringProvider
     */
    public function testIsArrayOfString($value, $expected): void
    {
        $result = Util::isArrayOfString($value);

        $this->assertEquals($result, $expected);
    }

    public static function isArrayOfStringProvider(): array
    {
        return [
            'Should be valid when value is an array of string' => [['foo', 'baz', 'bar'], true],
            'Should not be valid when value is an array of number' => [[1, 2, 3], false],
            'Should not be valid when value is an array of number and string' => [[1, 'foo', 'baz'], false],
        ];
    }
}
