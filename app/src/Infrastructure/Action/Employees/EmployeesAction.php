<?php declare(strict_types=1);

namespace App\Infrastructure\Action\Employees;

use App\Application\DB\Database;
use App\Application\Query\AllEmployeesQuery;
use App\Infrastructure\Http\AbstractAction;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class EmployeesAction extends AbstractAction
{
    /**
     * <GET>
     *
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        // Todo: Нужна реализация DI контейнера
        $employees = (new AllEmployeesQuery(Database::instance()))->query();

        return $this->createJsonResponse($employees);
    }
}