<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Id;

class IdPackage
{
    use Id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}

class IdTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfIdIsValid($value, $expected): void {
        $attribute = new IdPackage($value);

        $isValid = $attribute->idIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is an UUID' => ['550e8400-e29b-41d4-a716-446655440000', true],
            'Should not be valid when value is a false UUID' => ['5508400-e29b-41d4-a716-44665540000', false],
            'Should not be valid when value is empty' => ['', false],
            'Should not be valid when value is null' => [null, false],
        ];
    }
}
