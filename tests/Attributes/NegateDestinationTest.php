<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\NegateDestination;

class NegateDestinationPackage
{
    use NegateDestination;

    public function __construct($negateDestination)
    {
        $this->negateDestination = $negateDestination;
    }
}

class NegateDestinationTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfNegateDestinationIsValid($value, $expected): void {
        $attribute = new NegateDestinationPackage($value);

        $isValid = $attribute->negateDestinationIsValid();

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
