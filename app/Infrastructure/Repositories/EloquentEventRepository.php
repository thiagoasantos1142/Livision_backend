<?php

// app/Infrastructure/Repositories/EloquentEventRepository.php
namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\EventRepositoryInterface;
use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentEventRepository implements EventRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Event::paginate($perPage);
    }

    public function delete(int $id): bool
    {
        $event = Event::find($id);
        
        if (!$event) {
            return false;
        }

        return $event->delete();
    }
}
