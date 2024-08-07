<?php declare(strict_types=1);

namespace PAN;

/**
 * Cache interface for saving token
 */
interface CacheInterface
{
    // cache will expire in 12 minutes
    const EXPIRE = 720;

    /**
     * set token.
     *
     * @param string $token Path to send to request.
     */
    public function set(string $token): void;

    /**
     * get token.
     *
     * @return string
     */
    public function get(): string;
}
