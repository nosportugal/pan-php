<?php declare(strict_types=1);

namespace PAN;

use PAN\CacheInterface;

class Cache
{
    private array $list = [];
    private CacheInterface $cache;

    public function __construct(array $data = [])
    {
        $this->load();

        foreach ($this->list as $name => $className) {
            if (array_key_exists($name, $data)) {
                $this->cache = new $className($data[$name]);

                break;
            }
        }
    }

    public function set($token): void
    {
        if ($this->active()) {
            $this->cache->set($token);
        }
    }

    public function get(): string
    {
        if ($this->active()) {
            return $this->cache->get();
        }

        return '';
    }

    private function active(): bool
    {
        return isset($this->cache);
    }

    private function load(): void
    {
        foreach (glob(__DIR__ . '/Cache/*.php') as $filename) {
            preg_match('/\/(\w+)\.php$/', $filename, $matches);

            $value = $matches[1];

            $name = strtolower($value);
            $this->list[$name] = "PAN\\Cache\\" . $value;
        }
    }
}
