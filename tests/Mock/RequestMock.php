<?php declare(strict_types=1);

namespace PAN\Tests\Mock;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PAN\Request;
use PAN\Response;

class RequestMock extends Request
{
    private $status;
    private $data;

    public function __construct(array $data = [], int $status = 200)
    {
        $this->status = $status;
        $this->data = $data;
    }

    private function request(string $type, string $path, array $options): Response
    {
        $mock = new MockHandler([
            new \GuzzleHttp\Psr7\Response($this->status, ['Content-Type' => 'application/json;charset=UTF-8'], json_encode($this->data)),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $request = new Request($client);

        $method = strtolower($type);

        return $request->$method($path, $options);
    }
}
