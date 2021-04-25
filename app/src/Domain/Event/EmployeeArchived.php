<?php declare(strict_types=1);

namespace App\Domain\Event;

use App\Domain\AggregateRoot\DomainEvent;
use App\Domain\Entity\Employee\Employee;

class EmployeeArchived implements DomainEvent
{
    private Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function getEmployee(): Employee
    {
        return $this->employee;
    }
}