<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Employee\Employee;
use App\Domain\Entity\Employee\EmployeeId;
use App\Domain\Entity\Employee\Status;

interface EmployeeRepositoryInterface
{
    public function add(Employee $employee): void;
    public function findById(EmployeeId $id): ?Employee;
    public function changeStatus(EmployeeId $id, Status $status): void;
}