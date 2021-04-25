<?php declare(strict_types=1);

namespace App\Domain\Entity\Employee;

class EmployeeId
{
    private ?int $id;

    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}