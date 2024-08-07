<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Source;

class SourcePackage
{
    use Source;

    public function __construct($source)
    {
        $this->source = $source;
    }
}

class SourceTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfSourceIsValid($value, $expected): void {
        $attribute = new SourcePackage($value);

        $isValid = $attribute->sourceIsValid();

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
