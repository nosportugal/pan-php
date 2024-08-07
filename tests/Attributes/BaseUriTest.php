<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\BaseUri;

class BaseUriPackage
{
    use BaseUri;

    public function __construct($baseUri)
    {
        $this->baseUri = $baseUri;
    }
}

class BaseUriTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfBaseUriIsValid($value, $expected): void {
        $attribute = new BaseUriPackage($value);

        $isValid = $attribute->baseUriIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is API URL' => ['https://api.sase.paloaltonetworks.com', true],
            'Should not be valid when value is a false API URL' => ['api.sase.paloaltonetworks.com', false],
            'Should not be valid when value is empty' => ['', false],
            'Should not be valid when value is null' => [null, false],
        ];
    }
}
