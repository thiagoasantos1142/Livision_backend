<?php

namespace App\Application\UseCases\Events;

use App\Domain\Entities\EventEntity;
use App\Domain\Repositories\EventRepositoryInterface;

class FindEventByIdUseCase
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {}

    public function execute(int $id): ?EventEntity
    {
        return $this->eventRepository->findById($id);
    }
}
