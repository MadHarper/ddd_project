<?php declare(strict_types=1);

namespace App\Domain\AggregateRoot;

use BadMethodCallException;

class DomainEventPublisher
{
    private $subscribers;
    private static $instance = null;

    public static function instance(): DomainEventPublisher
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        $this->subscribers = [];
    }

    public function __clone()
    {
        throw new BadMethodCallException('Clone is not supported');
    }

    public function subscribe(DomainEventSubscriber $aDomainEventSubscriber): void
    {
        $this->subscribers[] = $aDomainEventSubscriber;
    }

    /**
     * @param DomainEvent[] $events
     */
    public function publishAll(array $events): void
    {
        foreach ($events as $event) {
            $this->publish($event);
        }
    }
    
    public function publish(DomainEvent $event): void
    {
        foreach ($this->subscribers as $subscriber) {
            if ($subscriber->isSubscribedTo($event)) {
                $subscriber->handle($event);
            }
        }
    }
}