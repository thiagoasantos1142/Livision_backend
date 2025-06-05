<?php

namespace App\Application\UseCases\Events;

use App\Domain\Entities\EventEntity;
use App\Domain\Repositories\EventRepositoryInterface;

class FindAllEventsUseCase
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {}

    /**
     * @return EventEntity[]
     */
    public function execute(): array
    {
        return $this->eventRepository->findAll();
    }
}
