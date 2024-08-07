<?php declare(strict_types=1);

namespace PAN;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use PAN\Response;
use PAN\RequestInterface;

class Request implements RequestInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(string $path, array $options = []): Response
    {
        return $this->request('GET', $path, $options);
    }

    public function post(string $path, array $options = []): Response
    {
        return $this->request('POST', $path, $options);
    }

    public function put(string $path, array $options = []): Response
    {
        return $this->request('PUT', $path, $options);
    }

    public function delete(string $path, array $options = []): Response
    {
        return $this->request('DELETE', $path, $options);
    }

    private function request(string $type, string $path, array $options): Response
    {
        try {
            $res = $this->client->request($type, $path, $options);

            return new Response(true, 200, json_decode($res->getBody()->getContents()));
        } catch (ClientException $e) {
            return $this->exceptionResponse($e);
        } catch (ServerException $e) {
            return $this->exceptionResponse($e);
        }
    }

    private function exceptionResponse($e): Response
    {
        $code = $e->getResponse()->getStatusCode();
        $body = json_decode($e->getResponse()->getBody()->getContents());

        return new Response(false, $code, $body);
    }
}
