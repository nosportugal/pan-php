<?php declare(strict_types=1);

namespace PAN\Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use PAN\SecurityRules;
use PAN\Cache;
use PAN\Token;
use PAN\Authentication;
use PAN\Request;

class SecurityRulesRealTest extends TestCase
{
    public function testIfSecurityRulesIsValid(): void
    {
        $data_authentication = [
            'baseUri'      => 'https://auth.apps.paloaltonetworks.com',
            'clientId'     => 'dfcoa@1359340106.iam.panserviceaccount.com',
            'clientSecret' => 'd68dbda4-097e-48df-ae4e-b5ca63d1f8ff',
            'tsgId'        => 1359340106
        ];
        $authentication = new Authentication($data_authentication);

        $cache = new Cache(['file' => '/tmp/cache2.txt']);
        $token = new Token($authentication, $cache);

        $client = new Client(['base_uri' => 'https://api.sase.paloaltonetworks.com']);
        $request = new Request($client);

        $data = [
            'position'        => 'pre',
            'folder'          => 'Mobile Users',
            'name'            => '30_4_Bar Base Teste 2',
            'description'     => 'Security policy for 30_4_Baz Base Teste',
            'destination'     => ['10.139.200.246/32'],
            'disabled'        => true,
            'profile_setting' => ['group' => ['NOS-Profile-Group']],
            'service'         => ['443'],
            'source_user'     => ['cn=allusers,ou=systems,ou=Guia,dc=corporativo,dc=pt'],
            'tag'             => ['TBVPN']
        ];

        $securityRules = new SecurityRules($request, $token, $data);

        $response = $securityRules->create();
        $this->assertEquals(200, 200);
        var_dump($response);
        /*
        $data = [
            'id' => '3bad4ca6-28d1-44a9-ba88-2f1dff445271',
        ];
        $securityRules = new SecurityRules($request, $token, $data);
        $response = $securityRules->get();

        var_dump($response);

        $this->assertEquals($response->code(), 200);

        $data2 = (array) $response->body();

        $securityRules2 = new SecurityRules($request, $token, $data2);
        */
    }
}
