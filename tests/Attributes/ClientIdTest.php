<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\ClientId;

class ClientIdPackage
{
    use ClientId;

    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }
}

class ClientIdTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfClientIdIsValid($value, $expected): void {
        $attribute = new ClientIdPackage($value);

        $isValid = $attribute->clientIdIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is an email' => ['foo@test.com', true],
            'Should not be valid when value is a false email' => ['foo@baz', false],
            'Should not be valid when value is empty' => ['', false],
            'Should not be valid when value is null' => [null, false],
        ];
    }
}
