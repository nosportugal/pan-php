<?php declare(strict_types=1);

namespace PAN;

// classes
use PAN\Base;
use PAN\Request;
use PAN\Token;

// attributes trait
use PAN\Attributes\Description;
use PAN\Attributes\Folder;
use PAN\Attributes\Fqdn;
use PAN\Attributes\Id;
use PAN\Attributes\IpNetmask;
use PAN\Attributes\IpRange;
use PAN\Attributes\IpWildcard;
use PAN\Attributes\Limit;
use PAN\Attributes\Name;
use PAN\Attributes\Offset;
use PAN\Attributes\Tag;

class Addresses extends Base
{
    use Description,
        Folder,
        Fqdn,
        Id,
        IpNetmask,
        IpRange,
        IpWildcard,
        Limit,
        Name,
        Offset,
        Tag;

    private Request $request;
    private Token $token;

    public function __construct(Request $request, Token $token, array $data = [])
    {
        parent::__construct($data);

        $this->request = $request;
        $this->token = $token;
    }

    public function list()
    {
        $token = $this->token->getToken();

        $this->skipAttribute('name');

        $response = $this->request->get(
            '/sse/config/v1/addresses',
            [
                'headers' => $this->headers($token),
                'query'   => $this->query('folder', 'limit', 'name', 'offset')
            ]
        );

        return $response;
    }

    public function create()
    {
        $token = $this->token->getToken();

        $this->skipAttribute('id');

        $response = $this->request->post(
            '/sse/config/v1/addresses',
            [
                'headers' => $this->headers($token),
                'query'   => $this->query('folder'),
                'json'    => $this->json()
            ]
        );

        return $response;
    }

    public function delete()
    {
        $token = $this->token->getToken();

        $response = $this->request->delete(
            "/sse/config/v1/addresses/{$this->id}",
            [
                'headers' => $this->headers($token)
            ]
        );

        return $response;
    }

    public function get()
    {
        $token = $this->token->getToken();

        $response = $this->request->get(
            "/sse/config/v1/addresses/{$this->id}",
            [
                'headers' => $this->headers($token)
            ]
        );

        return $response;
    }

    public function edit()
    {
        $this->skipAttribute('folder');

        $token = $this->token->getToken();

        $response = $this->request->put(
            "/sse/config/v1/addresses/{$this->id}",
            [
                'headers' => $this->headers($token),
                'json'    => $this->json()
            ]
        );

        return $response;
    }

    private function setSkip(): void
    {
        $this->skipAttribute('id');

        if (isset($this->ipNetmask)) {
            $this->skipAttribute('fqdn');
            $this->skipAttribute('ipRange');
            $this->skipAttribute('ipWildcard');
        } elseif (isset($this->ipRange)) {
            $this->skipAttribute('fqdn');
            $this->skipAttribute('ipNetmask');
            $this->skipAttribute('ipWildcard');
        } elseif (isset($this->ipWildcard)) {
            $this->skipAttribute('fqdn');
            $this->skipAttribute('ipNetmask');
            $this->skipAttribute('ipRange');
        } elseif (isset($this->fqdn)) {
            $this->skipAttribute('ipNetmask');
            $this->skipAttribute('ipRange');
            $this->skipAttribute('ipWildcard');
        }
    }
}
