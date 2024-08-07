<?php declare(strict_types=1);

namespace PAN\Tests\Mock;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PAN\Authentication;
use PAN\Request;
use PAN\Response;

class AuthenticationMock extends Authentication
{
    protected $request;

    public function __construct(array $data = [])
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
        $client = new Client(['handler' => $handlerStack]);
        $this->request = new Request($client);
    }

    public function createAnAccessToken(): Response
    {
        $response = $this->request->post('/oauth2/access_token', [
            'auth' => [$this->clientId, $this->clientSecret],
            'form_params' => [
                'grant_type' => 'client_credentials',
                'scope'      => "tsg_id:{$this->tsgId}"
            ]
        ]);

        return $response;
    }
}
