<?php

namespace App\Application\UseCases\Events;

use App\Domain\Entities\EventEntity;
use App\Domain\Repositories\EventRepositoryInterface;

class CreateEventUseCase
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {}

    public function execute(EventEntity $event): EventEntity
    {
        return $this->eventRepository->create($event);
    }

}
