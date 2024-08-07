<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Fqdn;

class FqdnPackage
{
    use Fqdn;

    public function __construct($fqdn)
    {
        $this->fqdn = $fqdn;
    }
}

class FqdnTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfFqdnIsValid($value, $expected): void {
        $attribute = new FqdnPackage($value);

        $isValid = $attribute->fqdnIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is domain fqdn' => ['mail.corporativo.pt', true],
            'Should not be valid when value is numeric' => [12345, false],
            'Should not be valid when value is null' => [null, false],
            'Should not be valid when value is true' => [true, false],
            'Should not be valid when value is false' => [false, false],
            'Should not be valid when value is array' => [['foo', 'baz'], false],
            'Should not be valid when value is object' => [new \stdClass(), false]
        ];
    }
}
