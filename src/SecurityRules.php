<?php declare(strict_types=1);

namespace PAN;

// classes
use PAN\Base;
use PAN\Request;
use PAN\Token;

// attributes trait
use PAN\Attributes\Action;
use PAN\Attributes\Application;
use PAN\Attributes\Category;
use PAN\Attributes\Description;
use PAN\Attributes\Destination;
use PAN\Attributes\DestinationHip;
use PAN\Attributes\DestinationRule;
use PAN\Attributes\Disabled;
use PAN\Attributes\Folder;
use PAN\Attributes\From;
use PAN\Attributes\Id;
use PAN\Attributes\Limit;
use PAN\Attributes\LogSetting;
use PAN\Attributes\Name;
use PAN\Attributes\NegateDestination;
use PAN\Attributes\NegateSource;
use PAN\Attributes\Offset;
use PAN\Attributes\ProfileSetting;
use PAN\Attributes\Position;
use PAN\Attributes\Rulebase;
use PAN\Attributes\Service;
use PAN\Attributes\Source;
use PAN\Attributes\SourceHip;
use PAN\Attributes\SourceUser;
use PAN\Attributes\Tag;
use PAN\Attributes\To;

class SecurityRules extends Base
{
    use Action,
        Application,
        Category,
        Description,
        Destination,
        DestinationHip,
        DestinationRule,
        Disabled,
        Folder,
        From,
        Id,
        Limit,
        LogSetting,
        Name,
        NegateDestination,
        NegateSource,
        Offset,
        ProfileSetting,
        Position,
        Rulebase,
        Service,
        Source,
        SourceHip,
        SourceUser,
        Tag,
        To;

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
            '/sse/config/v1/security-rules',
            [
                'headers' => $this->headers($token),
                'query'   => $this->query('folder', 'limit', 'name', 'position', 'offset')
            ]
        );

        return $response;
    }

    public function create()
    {
        $token = $this->token->getToken();

        $this->skipAttribute('id');
        $this->skipAttribute('rulebase');

        $response = $this->request->post(
            '/sse/config/v1/security-rules',
            [
                'headers' => $this->headers($token),
                'query'   => $this->query('position', 'folder'),
                'json'    => $this->json()
            ]
        );

        return $response;
    }

    public function delete()
    {
        $token = $this->token->getToken();

        $response = $this->request->delete(
            "/sse/config/v1/security-rules/{$this->id}",
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
            "/sse/config/v1/security-rules/{$this->id}",
            [
                'headers' => $this->headers($token)
            ]
        );

        return $response;
    }

    public function edit()
    {
        $token = $this->token->getToken();

        $this->skipAttribute('rulebase');

        $response = $this->request->put(
            "/sse/config/v1/security-rules/{$this->id}",
            [
                'headers' => $this->headers($token),
                'query'   => $this->query('position', 'folder'),
                'json'    => $this->json()
            ]
        );

        return $response;
    }

    public function move()
    {
        $token = $this->token->getToken();

        $response = $this->request->post(
            "/sse/config/v1/security-rules/{$this->id}",
            [
                'headers' => $this->headers($token),
                'query'   => $this->query('folder'),
                'json'    => $this->json('destination', 'destination_rule', 'rulebase')
            ]
        );

        return $response;
    }
}
