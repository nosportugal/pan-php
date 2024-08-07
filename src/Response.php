<?php declare(strict_types=1);

namespace PAN;

use PAN\ResponseInterface;

class Response implements ResponseInterface
{
    private array $data = [];

    public function __construct(bool $success, int $code, object $body)
    {
        $this->data['success'] = $success;
        $this->data['code'] = $code;
        $this->data['body'] = $body;
    }

    public function success(): bool
    {
        return $this->data['success'];
    }

    public function code(): int
    {
        return $this->data['code'];
    }

    public function body(): object
    {
        return $this->data['body'];
    }
}
