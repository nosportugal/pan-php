<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Offset;

class OffsetPackage
{
    use Offset;

    public function __construct($offset)
    {
        $this->offset = $offset;
    }
}

class OffsetTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfOffsetIsValid($value, $expected): void {
        $attribute = new OffsetPackage($value);

        $isValid = $attribute->offsetIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when the value is int positive' => [10, true],
            'Should be valid when the value is zero' => [0, true],
            'Should not be valid when the value is int negative' => [-10, false],
            'Should not be valid when the value is string' => ['', false],
            'Should not be valid when the value is null' => [null, false],
        ];
    }
}
