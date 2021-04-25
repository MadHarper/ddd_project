<?php declare(strict_types=1);

namespace App\Infrastructure\Action\CreateEmployee;

use App\Infrastructure\Http\Response;

class OkResponse extends Response
{
    public function __construct()
    {
        parent::__construct(
            json_encode(['result' => 'ok'], JSON_THROW_ON_ERROR)
        );
    }
}