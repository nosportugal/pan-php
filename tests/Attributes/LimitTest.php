<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Limit;

class LimitPackage
{
    use Limit;

    public function __construct($limit)
    {
        $this->limit = $limit;
    }
}

class LimitTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfLimitIsValid($value, $expected): void {
        $attribute = new LimitPackage($value);

        $isValid = $attribute->limitIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when the value is int positive' => [10, true],
            'Should not be valid when the value is zero' => [0, false],
            'Should not be valid when the value is int negative' => [-20, false],
            'Should not be valid when the value is string' => ['', false],
            'Should not be valid when the value is null' => [null, false],
        ];
    }
}
