<?php declare(strict_types=1);

namespace App\Domain\Entity\Employee;

use App\Domain\AggregateRoot\AggregateRoot;
use App\Domain\AggregateRoot\EventTrait;
use App\Domain\Event\EmployeeArchived;
use DateTimeImmutable;
use DomainException;

class Employee implements AggregateRoot
{
    use EventTrait;

    private EmployeeId $id;
    private FullName $fullName;
    private Address $address;
    private PhonesCollection $phones;
    private Status $status;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    public function __construct(
        EmployeeId $employeeId,
        FullName $fullName,
        Address $address,
        PhonesCollection $phones,
        ?Status $status = null,
        ?DateTimeImmutable $createdAt = null,
        ?DateTimeImmutable $updatedAt = null
    ) {
        $this->id = $employeeId;
        $this->fullName = $fullName;
        $this->address = $address;
        if ($phones->isEmpty()) {
            throw new DomainException('There must be at least one phone.');
        }
        $this->phones = $phones;
        $this->status = $status ?? new Status();
        $this->createdAt = $createdAt ?? new DateTimeImmutable();
        $this->updatedAt = $updatedAt ?? new DateTimeImmutable();
    }

    public function getId(): EmployeeId
    {
        return clone $this->id;
    }

    public function getFullName(): FullName
    {
        return clone $this->fullName;
    }

    public function getAddress(): Address
    {
        return clone $this->address;
    }

    public function getPhones(): PhonesCollection
    {
        return clone $this->phones;
    }

    public function getStatus(): Status
    {
        return clone $this->status;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return clone $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return clone $this->updatedAt;
    }

    public function sendToArchive(): void
    {
        $this->status = new Status(Status::ARCHIVED_STATUS);
        $this->update();

        $this->recordEvent(new EmployeeArchived($this));
    }

    private function update(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }
}