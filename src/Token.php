<?php declare(strict_types=1);

namespace PAN;

use PAN\Authentication;
use PAN\Cache;

class Token
{
    private Authentication $authentication;
    private Cache $cache;

    public function __construct(Authentication $authentication, Cache $cache)
    {
        $this->authentication = $authentication;
        $this->cache = $cache;
    }

    public function getToken(): string
    {
        // get cache
        if ($this->cache->get() != '') {
            return $this->cache->get();
        }

        $token = $this->generateToken();

        // set cache
        $this->cache->set($token);

        return $token;
    }

    private function generateToken(): string
    {
        $response = $this->authentication->createAnAccessToken();

        if ($response->success()) {
            $body = $response->body();

            return $body->access_token;
        }

        $message = "Error status {$response->code()} - {$response->body()->error}";
        throw new \Exception($message);
    }
}
