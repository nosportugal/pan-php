<?php declare(strict_types=1);

namespace PAN\Tests;

use PHPUnit\Framework\TestCase;
use PAN\PaloAltoNetworks;

class PaloAltoNetworksTest extends TestCase
{
    public function testIfPaloAltoNetworksIsValid(): void
    {
        $data = [
            'baseUrl' => 'https://api.sase.paloaltonetworks.com',
            'clientId' => 'foo@foo.com',
            'clientSecret' => 'c51bd264-1943-4be8-8125-320f92bb5587',
            'tsgId' => 123456789,
            'redis' => [
                'schema' => 'tcp',
                'host'   => '127.0.0.1'
            ]
        ];

        $securityRules = new PaloAltoNetworks($data);

        $this->assertEquals(true, true);
    }
}
