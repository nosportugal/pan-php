<?php declare(strict_types=1);

namespace PAN\Tests;

use PHPUnit\Framework\TestCase;
use PAN\Request;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class CreateAnAccessTokenTest extends TestCase
{
    public function testCreateAnAccessTokenError400()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://auth.apps.paloaltonetworks.com']);
        $request = new Request($client);
        $response = $request->post('/oauth2/access_token');

        $this->assertEquals(get_class($response), 'PAN\Response');
        $this->assertEquals($response->success(), false);
        $this->assertEquals($response->code(), 400);
        $this->assertEquals($response->body()->error, 'invalid_request');
    }

    public function testCreateAnAccessTokenError401()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://auth.apps.paloaltonetworks.com']);
        $request = new Request($client);
        $response = $request->post('/oauth2/access_token', [
            'auth' => ['username', 'password'],
            'form_params' => [
                'grant_type' => 'client_credentials',
                'scope'      => 'tsg_id:123456789'
            ]
        ]);

        $this->assertEquals(get_class($response), 'PAN\Response');
        $this->assertEquals($response->success(), false);
        $this->assertEquals($response->code(), 401);
        $this->assertEquals($response->body()->error, 'invalid_client');
    }

    public function testCreateAnAccessTokenSuccess()
    {
        $data = [
            'access_token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c',
            'scope'        => 'tsg_id:123456789 profile email',
            'token_type'   => 'Bearer',
            'expires_in'   => 899
        ];

        $mock = new MockHandler([
            new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'application/json;charset=UTF-8'], json_encode($data)),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new \GuzzleHttp\Client(['handler' => $handlerStack]);
        $request = new Request($client);
        $response = $request->post('/oauth2/access_token', [
            'auth' => ['Foo', 'baz'],
            'form_params' => [
                'grant_type' => 'client_credentials',
                'scope'      => 'tsg_id:123456789'
            ]
        ]);

        $this->assertEquals(get_class($response), 'PAN\Response');
        $this->assertEquals($response->success(), true);
        $this->assertEquals($response->code(), 200);

        $body = $response->body();
        $this->assertEquals($body->access_token, 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c');
        $this->assertEquals($body->scope, 'tsg_id:123456789 profile email');
        $this->assertEquals($body->token_type, 'Bearer');
        $this->assertEquals($body->expires_in, 899);
    }
}
