<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\SourceUser;

class SourceUserPackage
{
    use SourceUser;

    public function __construct($sourceUser)
    {
        $this->sourceUser = $sourceUser;
    }
}

class SourceUserTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfSourceUserIsValid($value, $expected): void {
        $attribute = new SourceUserPackage($value);

        $isValid = $attribute->sourceUserIsValid();

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
