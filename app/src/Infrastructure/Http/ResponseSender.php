<?php

namespace App\Infrastructure\Http;

class ResponseSender
{
    public function send(Response $response): void
    {
        header('HTTP/1.0 ' . $response->getStatusCode() . ' ' . $response->getReasonPhrase());

        foreach ($response->getHeaders() as $name => $value) {
            header(sprintf('%s: %s', $name, $value), false);
        }
        echo $response->getBody();
    }
}