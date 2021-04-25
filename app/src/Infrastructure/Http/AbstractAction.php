<?php declare(strict_types=1);

namespace App\Infrastructure\Http;

abstract class AbstractAction
{
    abstract function handle(Request $request): Response;

    protected function createJsonResponse(array $data): Response
    {
        return (new Response(json_encode(['result' => $data])))
            ->withHeader('content-type', 'application/json');
    }
}