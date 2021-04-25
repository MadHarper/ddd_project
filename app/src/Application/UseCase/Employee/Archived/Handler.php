<?php declare(strict_types=1);

namespace App\Application\UseCase\Employee\Archived;

use App\Domain\Entity\Employee\Employee;
use App\Domain\Entity\Employee\EmployeeId;
use App\Domain\Repository\EmployeeRepositoryInterface;

class Handler
{
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function handle(Command $command): void
    {
        $employee = $this->employeeRepository->findById(new EmployeeId($command->id));

        if (!$employee instanceof Employee) {
            throw new \InvalidArgumentException('Not found');
        }

        $employee->sendToArchive();
        $this->employeeRepository->update($employee);
    }

}