<?php

namespace App\Application\UseCases\Events;

use App\Domain\Repositories\EventRepositoryInterface;

class FindEventByIdUseCase
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {}

    public function execute(int $id)
    {
        return $eventRepository->findById($id);
    }
}
