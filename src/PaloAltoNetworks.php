<?php declare(strict_types=1);

namespace PAN;

use GuzzleHttp\Client;

// classes
use PAN\Base;
use PAN\Cache;
use PAN\Authentication;
use PAN\Request;
use PAN\Token;
use PAN\Addresses;
use PAN\SecurityRules;
use PAN\Services;
use PAN\Tags;

// attributes trait
use PAN\Attributes\ClientId;
use PAN\Attributes\ClientSecret;
use PAN\Attributes\TsgId;

class PaloAltoNetworks extends Base
{
    use ClientId,
        ClientSecret,
        TsgId;

    private Request $request;
    private Token $token;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        // check if attributes is valid
        $this->attributesIsValid();

        $client = new Client(['base_uri' => 'https://api.sase.paloaltonetworks.com']);
        $this->request = new Request($client);

        $authentication = new Authentication([
            'baseUri'      => 'https://auth.apps.paloaltonetworks.com',
            'clientId'     => $this->clientId,
            'clientSecret' => $this->clientSecret,
            'tsgId'        => $this->tsgId
        ]);

        $cache = new Cache($data);

        // create token to generate token
        $this->token = new Token($authentication, $cache);

        // create client to request
        $client = new Client(['base_uri' => 'https://api.sase.paloaltonetworks.com']);
        $this->request = new Request($client);
    }

    public function addresses(array $data = []): Addresses
    {
        return new Addresses($this->request, $this->token, $data);
    }

    public function securityRules(array $data = []): SecurityRules
    {
        return new SecurityRules($this->request, $this->token, $data);
    }

    public function services(array $data = []): Services
    {
        return new Services($this->request, $this->token, $data);
    }

    public function tags(array $data = []): Tags
    {
        return new Tags($this->request, $this->token, $data);
    }
}
