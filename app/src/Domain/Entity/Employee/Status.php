<?php declare(strict_types=1);

namespace App\Domain\Entity\Employee;

use DateTimeImmutable;
use DomainException;

class Status
{
    public const ACTIVATED_STATUS = 'activated';
    public const ARCHIVED_STATUS = 'archived';

    private ?string $statusName;
    private ?DateTimeImmutable $statusDate;

    public function __construct(string $statusName = self::ACTIVATED_STATUS, ?DateTimeImmutable $statusDate = null)
    {
        if (!in_array($statusName, [self::ACTIVATED_STATUS, self::ARCHIVED_STATUS], true)) {
            throw new DomainException('Status is not correct.');
        }
        $this->statusName = $statusName;
        $this->statusDate = $statusDate ?? new DateTimeImmutable();
    }

    public function getStatusName(): ?string
    {
        return $this->statusName;
    }

    public function getDate(): ?DateTimeImmutable
    {
        return $this->statusDate;
    }
}