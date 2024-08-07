<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Position;

class PositionPackage
{
    use Position;

    public function __construct($position)
    {
        $this->position = $position;
    }
}

class PositionTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfPositionIsValid($value, $expected): void {
        $attribute = new PositionPackage($value);

        $isValid = $attribute->positionIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is pre' => ['pre', true],
            'Should be valid when value is post' => ['post', true],
            'Should be valid when value is empty' => ['', false],
        ];
    }
}
