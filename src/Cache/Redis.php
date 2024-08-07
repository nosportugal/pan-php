<?php declare(strict_types=1);

namespace PAN\Cache;

use PAN\CacheInterface;

class Redis implements CacheInterface
{
    private $client;

    public function __construct(array $config)
    {
        $this->client = new \Predis\Client($config);
    }

    public function set(string $token): void
    {
        $this->client->set('cache:token', $token, 'EX', $this::EXPIRE);
    }

    public function get(): string
    {
        return $this->client->get('cache:token');
    }
}
