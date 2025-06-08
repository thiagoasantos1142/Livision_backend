<?php

// app/Application/UseCases/Events/DeleteEventUseCase.php

namespace App\Application\UseCases\Events;

use App\Domain\Repositories\EventRepositoryInterface;

class DeleteEventUseCase
{
    public function __construct(private EventRepositoryInterface $repository)
    {
    }

    public function execute(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
