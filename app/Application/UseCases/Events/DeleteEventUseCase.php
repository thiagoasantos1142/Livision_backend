<?php

namespace App\Application\UseCases\Events;

use App\Domain\Repositories\EventRepositoryInterface;

class DeleteEventUseCase
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {}

    public function execute(int $id): bool
    {
        return $eventRepository->delete($id);
    }
}
