<?php declare(strict_types=1);

namespace App\Infrastructure\Action\Archived;

use App\Application\DB\Database;
use App\Application\Repository\EmployeeRepository;
use App\Application\UseCase\Employee\Archived\Command;
use App\Application\UseCase\Employee\Archived\Handler;
use App\Infrastructure\Action\CreateEmployee\OkResponse;
use App\Infrastructure\Http\AbstractAction;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class ArchivedAction extends AbstractAction
{
    /**
     * <POST>
     *
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $command = new Command();
        $command->id = (int)$request->request('id');
        $repo = new EmployeeRepository(Database::instance());
        (new Handler($repo))->handle($command);

        return new OkResponse();
    }
}