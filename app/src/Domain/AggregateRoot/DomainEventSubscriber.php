<?php

namespace App\Domain\AggregateRoot;

interface DomainEventSubscriber
{
    public function handle($event): void;
    public function isSubscribedTo(DomainEvent $event): bool;
}