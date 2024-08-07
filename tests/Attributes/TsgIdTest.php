<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\TsgId;

class TsgIdPackage
{
    use TsgId;

    public function __construct($tsgId)
    {
        $this->tsgId = $tsgId;
    }
}

class TsgIdTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfTsgIdIsValid($value, $expected): void {
        $attribute = new TsgIdPackage($value);

        $isValid = $attribute->tsgIdIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is numeric' => [123456789, true],
            'Should not be valid when value is float' => [12345,6789, false],
            'Should not be valid when value is null' => [null, false],
            'Should not be valid when value is string' => ['123456789', false],
        ];
    }
}
