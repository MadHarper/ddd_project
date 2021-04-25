<?php declare(strict_types=1);

namespace App\Infrastructure\Action\CreateEmployee;

use App\Application\DB\Database;
use App\Application\Repository\EmployeeRepository;
use App\Application\UseCase\Employee\Create\Command;
use App\Application\UseCase\Employee\Create\Handler;
use App\Infrastructure\Http\AbstractAction;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class CreateEmployeeAction extends AbstractAction
{
    /**
     * <POST>
     *
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        // Todo: валидация данных из запроса
        $command = new Command();
        $command->firstName = trim($request->request('firstName'));
        $command->lastName = trim($request->request('lastName'));
        $command->middleName = trim($request->request('middleName'));
        $command->country = trim($request->request('country'));
        $command->city = trim($request->request('city'));
        $command->region = trim($request->request('region'));
        $command->street = trim($request->request('street'));
        $command->apartment = trim($request->request('apartment'));
        $command->phones = $request->request('phones') ?? [];

        // Todo: Нужна реализация DI контейнера
        $handler = new Handler(new EmployeeRepository(Database::instance()));
        $handler->handle($command);

        return new OkResponse();
    }
}