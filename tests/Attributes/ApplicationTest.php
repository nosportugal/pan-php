<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Application;

class ApplicationPackage
{
    use Application;

    public function __construct($application)
    {
        $this->application = $application;
    }
}

class ApplicationTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfApplicationIsValid($value, $expected): void {
        $attribute = new ApplicationPackage($value);

        $isValid = $attribute->applicationIsValid();

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
