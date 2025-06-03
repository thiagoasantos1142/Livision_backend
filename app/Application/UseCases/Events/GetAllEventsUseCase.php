<?php

namespace App\Application\UseCases\Events;

use App\Domain\Repositories\EventRepositoryInterface;

class GetAllEventsUseCase
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {}

    public function execute(): array
    {
        return $eventRepository->getAll();
    }
}
