<?php declare(strict_types=1);

namespace PAN;

// classes
use PAN\Base;
use PAN\Request;
use PAN\Token;

// attributes trait
use PAN\Attributes\Description;
use PAN\Attributes\Folder;
use PAN\Attributes\Id;
use PAN\Attributes\Limit;
use PAN\Attributes\Name;
use PAN\Attributes\Offset;
use PAN\Attributes\Protocol;
use PAN\Attributes\Tag;

class Services extends Base
{
    use Description,
        Folder,
        Id,
        Limit,
        Name,
        Offset,
        Protocol,
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
            '/sse/config/v1/services',
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
            '/sse/config/v1/services',
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
            "/sse/config/v1/services/{$this->id}",
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
            "/sse/config/v1/services/{$this->id}",
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
            "/sse/config/v1/services/{$this->id}",
            [
                'headers' => $this->headers($token),
                'json'    => $this->json()
            ]
        );

        return $response;
    }
}
