<?php declare(strict_types=1);

namespace App\Application\Mail;

use App\Domain\AggregateRoot\DomainEvent;
use App\Domain\AggregateRoot\DomainEventSubscriber;
use App\Domain\Event\EmployeeArchived;

class ArchiveMailer implements DomainEventSubscriber
{
    public function handle($event): void
    {
        var_dump(100);
        // TODO: Send email
    }

    public function isSubscribedTo(DomainEvent $event): bool
    {
        return $event instanceof EmployeeArchived;
    }
}