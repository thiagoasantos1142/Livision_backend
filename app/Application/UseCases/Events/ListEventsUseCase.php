<?php

// app/Application/UseCases/Events/ListEventsUseCase.php
namespace App\Application\UseCases\Events;

use App\Domain\Repositories\EventRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListEventsUseCase
{
    public function __construct(private EventRepositoryInterface $repository)
    {
    }

    public function execute(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }
}
