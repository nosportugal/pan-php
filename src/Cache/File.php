<?php declare(strict_types=1);

namespace PAN\Cache;

use PAN\CacheInterface;

class File implements CacheInterface
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function set(string $token): void
    {
        $expire = (time() + $this::EXPIRE);

        $data = $expire . ';' . $token;

        file_put_contents($this->file, $data);
    }

    public function get(): string
    {
        if (file_exists($this->file)) {
            $data = file_get_contents($this->file);

            list($expire, $token) = explode(';', $data);

            return $expire >= time() ? $token : '';
        }

        return '';
    }
}
