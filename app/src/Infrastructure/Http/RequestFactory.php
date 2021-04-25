<?php declare(strict_types=1);

namespace App\Infrastructure\Http;

class RequestFactory
{
    public static function fromGlobals(array $query = null, array $body = null): Request
    {
        return (new Request())
            ->setParsedBody($body ?: $_POST)
            ->setQueryParams($query ?: $_GET)
            ->setUri($_SERVER['REQUEST_URI'])
        ;
    }
}