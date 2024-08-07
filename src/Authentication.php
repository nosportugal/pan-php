<?php declare(strict_types=1);

namespace PAN;

use GuzzleHttp\Client;
use PAN\Base;
use PAN\Request;
use PAN\Response;

// attributes trait
use PAN\Attributes\BaseUri;
use PAN\Attributes\ClientId;
use PAN\Attributes\ClientSecret;
use PAN\Attributes\TsgId;

class Authentication extends Base
{
    use BaseUri,
        ClientId,
        ClientSecret,
        TsgId;

    private Request $request;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $client = new Client(['base_uri' => $this->baseUri]);
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
