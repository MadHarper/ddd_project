<?php

namespace App\Domain\AggregateRoot;

interface AggregateRoot
{
    public function releaseEvents();
}