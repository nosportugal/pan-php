<?php declare(strict_types=1);

namespace PAN;

/**
 * Response interface for returning data from HTTP requests.
 */
interface ResponseInterface
{
    /**
     * @return bool
     */
    public function success(): bool;

    /**
     * @return int
     */
    public function code(): int;

    /**
     * @return object
     */
    public function body(): object;
}
