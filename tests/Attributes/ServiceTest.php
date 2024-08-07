<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Service;

class ServicePackage
{
    use Service;

    public function __construct($service)
    {
        $this->service = $service;
    }
}

class ServiceTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfServiceIsValid($value, $expected): void {
        $attribute = new ServicePackage($value);

        $isValid = $attribute->serviceIsValid();

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
