<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\SourceHip;

class SourceHipPackage
{
    use SourceHip;

    public function __construct($sourceHip)
    {
        $this->sourceHip = $sourceHip;
    }
}

class SourceHipTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfSourceHipIsValid($value, $expected): void {
        $attribute = new SourceHipPackage($value);

        $isValid = $attribute->sourceHipIsValid();

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
