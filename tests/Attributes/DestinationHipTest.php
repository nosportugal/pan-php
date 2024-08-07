<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\DestinationHip;

class DestinationHipPackage
{
    use DestinationHip;

    public function __construct($destinationHip)
    {
        $this->destinationHip = $destinationHip;
    }
}

class DestinationHipTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfDestinationHipIsValid($value, $expected): void {
        $attribute = new DestinationHipPackage($value);

        $isValid = $attribute->destinationHipIsValid();

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
