<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\SecurityRules;
use PAN\Cache;
use PAN\Token;
use PAN\Tests\Mock\AuthenticationMock;
use PAN\Tests\Mock\RequestMock;

class SecurityRulesTest extends TestCase
{
    public function testIfSecurityRulesIsValid(): void
    {
        $data_authentication = [
            'baseUri'      => 'https://auth.apps.paloaltonetworks.com',
            'clientId'     => 'foo@foo.com',
            'clientSecret' => '3ced47bf-4d09-4122-9b9d-afa0fe30fc8c',
            'tsgId'        => 1234567890
        ];
        $authentication = new AuthenticationMock($data_authentication);

        $cache = new Cache();
        $token = new Token($authentication, $cache);

        $data_request = [
            'created'
        ];

        $request = new RequestMock($data_request);

        $data = [
            'position' => 'pre',
            'folder'   => 'Shared',
            'action'   => 'Foo'
        ];

        $securityRules = new SecurityRules($request, $token, $data);
        $this->assertEquals($securityRules->positionIsValid(), true);
        $this->assertEquals($securityRules->folderIsValid(), true);
    }
}
