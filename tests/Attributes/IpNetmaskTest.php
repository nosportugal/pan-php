<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\IpNetmask;

class IpNetmaskPackage
{
    use IpNetmask;

    public function __construct($ipNetmask)
    {
        $this->ipNetmask = $ipNetmask;
    }
}

class IpNetmaskTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfIpNetmaskIsValid($value, $expected): void {
        $attribute = new IpNetmaskPackage($value);

        $isValid = $attribute->ipNetmaskIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is ip mask ipv4' => ['255.255.255.0', true],
            'Should be valid when value is ip mask ipv6' => ['FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:0000', true],
            'Should not be valid when value is numeric' => [12345, false],
            'Should not be valid when value is null' => [null, false],
            'Should not be valid when value is true' => [true, false],
            'Should not be valid when value is false' => [false, false],
            'Should not be valid when value is array' => [['foo', 'baz'], false],
            'Should not be valid when value is object' => [new \stdClass(), false]
        ];
    }
}
