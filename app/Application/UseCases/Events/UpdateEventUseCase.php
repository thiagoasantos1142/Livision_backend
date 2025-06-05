<?php

namespace App\Application\UseCases\Events;

use App\Domain\Entities\EventEntity;
use App\Domain\Repositories\EventRepositoryInterface;

class UpdateEventUseCase
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {}

    public function execute(int $id, EventEntity $event): EventEntity
    {
        return $this->eventRepository->update($id, $event);
    }
}
