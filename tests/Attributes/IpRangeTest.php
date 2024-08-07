<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\IpRange;

class IpRangePackage
{
    use IpRange;

    public function __construct($ipRange)
    {
        $this->ipRange = $ipRange;
    }
}

class IpRangeTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfIpRangeIsValid($value, $expected): void {
        $attribute = new IpRangePackage($value);

        $isValid = $attribute->ipRangeIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is ip range' => ['10.217.50.0/24', true],
            'Should not be valid when value is numeric' => [12345, false],
            'Should not be valid when value is null' => [null, false],
            'Should not be valid when value is true' => [true, false],
            'Should not be valid when value is false' => [false, false],
            'Should not be valid when value is array' => [['foo', 'baz'], false],
            'Should not be valid when value is object' => [new \stdClass(), false]
        ];
    }
}
