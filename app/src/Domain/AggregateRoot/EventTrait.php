<?php declare(strict_types=1);

namespace App\Domain\AggregateRoot;

trait EventTrait
{
    private $events = [];

    protected function recordEvent(DomainEvent $event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return DomainEvent[]
     */
    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}