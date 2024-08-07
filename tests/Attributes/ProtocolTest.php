<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Protocol;

class ProtocolPackage
{
    use Protocol;

    public function __construct($protocol)
    {
        $this->protocol = $protocol;
    }
}

class ProtocolTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfProtocolIsValid($value, $expected): void {
        $attribute = new ProtocolPackage($value);

        $isValid = $attribute->protocolIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is an array tcp -> port' => [
                [
                    'tcp' => [
                        'port' => '443'
                    ]
                ],
                true
            ],
            'Should be valid when value is an array udp -> port' => [
                [
                    'udp' => [
                        'port' => '443'
                    ]
                ],
                true
            ],
            'Should be valid when value is an array tcp -> timeout' => [
                [
                    'tcp' => [
                        'timeout' => 3600
                    ]
                ],
                false
            ],
            'Should be valid when value is an array foo -> port' => [
                [
                    'foo' => [
                        'port' => '443'
                    ]
                ],
                false
            ]
        ];
    }
}
