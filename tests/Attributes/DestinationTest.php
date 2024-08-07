<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Destination;

class DestinationPackage
{
    use Destination;

    public function __construct($destination)
    {
        $this->destination = $destination;
    }
}

class DestinationTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfDestinationIsValid($value, $expected): void {
        $attribute = new DestinationPackage($value);

        $isValid = $attribute->destinationIsValid();

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
