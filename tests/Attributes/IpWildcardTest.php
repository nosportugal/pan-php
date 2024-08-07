<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\IpWildcard;

class IpWildcardPackage
{
    use IpWildcard;

    public function __construct($ipWildcard)
    {
        $this->ipWildcard = $ipWildcard;
    }
}

class IpWildcardTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfIpWildcardIsValid($value, $expected): void {
        $attribute = new IpWildcardPackage($value);

        $isValid = $attribute->ipWildcardIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is ip wildcard' => ['10.217.50.0', true],
            'Should not be valid when value is numeric' => [12345, false],
            'Should not be valid when value is null' => [null, false],
            'Should not be valid when value is true' => [true, false],
            'Should not be valid when value is false' => [false, false],
            'Should not be valid when value is array' => [['foo', 'baz'], false],
            'Should not be valid when value is object' => [new \stdClass(), false]
        ];
    }
}
