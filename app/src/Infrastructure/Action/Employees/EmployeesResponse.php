<?php declare(strict_types=1);

namespace App\Infrastructure\Action\Employees;

use App\Infrastructure\Http\Response;

class EmployeesResponse extends Response
{
    public function __construct(array $employees)
    {

        $this->withHeader('Content-Type', 'application/json');

        parent::__construct(
            json_encode(['result' => $employees], JSON_THROW_ON_ERROR)
        );

    }
}