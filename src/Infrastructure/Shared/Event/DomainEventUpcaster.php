<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Event;

use App\Domain\User\Event\UserWasCreated;
use App\Infrastructure\User\Upcasting\UserUpcaster;
use Broadway\Upcasting\Upcaster;

class DomainEventUpcaster implements Upcaster
{
    public function __construct(
        private UserUpcaster $userUpcaster
    ) {}

    public function supports(array $serializedEvent): bool
    {
        return $serializedEvent['class'] === UserWasCreated::class;
    }

    public function upcast(array $serializedEvent): array
    {
        return match ($serializedEvent['class']) {
            UserWasCreated::class => $this->userUpcaster->upcast($serializedEvent),
            default => $serializedEvent
        };
    }
}