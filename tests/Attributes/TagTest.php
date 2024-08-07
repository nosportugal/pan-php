<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Tag;

class TagPackage
{
    use Tag;

    public function __construct($tag)
    {
        $this->tag = $tag;
    }
}

class TagTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfTagIsValid($value, $expected): void {
        $attribute = new TagPackage($value);

        $isValid = $attribute->tagIsValid();

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
