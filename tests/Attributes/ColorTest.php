<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Color;

class ColorPackage
{
    use Color;

    public function __construct($color)
    {
        $this->setColor($color);
    }
}

class ColorTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfColorIsValid($value, $expected): void {
        $attribute = new ColorPackage($value);

        $isValid = $attribute->colorIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        $colors = ['Red', 'Blue', 'green'];

        $provider = [];

        foreach ($colors as $color) {
            $provider["Should be valid when value is {$color} color"] = [$color, true];
        }

        return $provider;
    }
}
