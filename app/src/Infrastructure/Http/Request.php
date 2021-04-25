<?php declare(strict_types=1);

namespace App\Infrastructure\Http;

class Request
{
    private $queryParams;
    private $parsedBody;
    private $uri;

    public function __construct(array $queryParams = [], $parsedBody = null, string $uri = '')
    {
        $this->queryParams = $queryParams;
        $this->parsedBody = $parsedBody;
        $this->uri = $uri;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function setQueryParams(array $queryParams): self
    {
        $clone = clone $this;
        $clone->queryParams = $queryParams;

        return $clone;
    }

    public function getParsedBody()
    {
        return $this->parsedBody;
    }

    public function setParsedBody(array $parsedBody): self
    {
        $clone = clone $this;
        $clone->parsedBody = $parsedBody;

        return $clone;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri(string $uri): self
    {
        $clone = clone $this;
        $clone->uri = $uri;

        return $clone;
    }

    public function request(string $key)
    {
        if (array_key_exists($key, $this->parsedBody)) {
            return $this->parsedBody[$key];
        }

        return null;
    }
}