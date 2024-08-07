<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Category;

class CategoryPackage
{
    use Category;

    public function __construct($category)
    {
        $this->category = $category;
    }
}

class CategoryTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfCategoryIsValid($value, $expected): void {
        $attribute = new CategoryPackage($value);

        $isValid = $attribute->categoryIsValid();

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
