<?php declare(strict_types=1);

namespace PAN\Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use PAN\Tags;
use PAN\Cache;
use PAN\Token;
use PAN\Authentication;
use PAN\Request;

class TagsRealTest extends TestCase
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
            'folder' => 'Mobile Users',
            'name'   => 'TBVPN',
        ];

        $tags = new Tags($request, $token, $data);
        $response = $tags->list();

        var_dump($response);

        /*
        $data = [
            'folder' => 'Mobile Users',
            'name'   => 'TBVPN',
        ];

        $tags = new Tags($request, $token, $data);

        $response = $tags->create();
        $this->assertEquals(200, 200);
        var_dump($response);
        */

        /*
        $data = [
            'id'    => '4e941adc-e73f-4f8a-b791-760d4be598d2',
            'name'  => 'TBVPN',
            'color' => 'red'
        ];

        $tags = new Tags($request, $token, $data);

        $response = $tags->edit();
        var_dump($response);
        */

        $this->assertEquals(true, true);
    }
}
