<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\EventEntity;
use App\Domain\Repositories\EventRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Event;

class EventRepository implements EventRepositoryInterface
{
    public function create(EventEntity $event): EventEntity
    {
        $model = Event::create($event->toArray());
        return EventEntity::fromModel($model);
    }

    public function find(int $id): ?EventEntity
    {
        $model = Event::with(['cameras', 'genres'])->find($id);

        if (!$model) {
            return null;
        }

        return EventEntity::fromModel($model);
    }

    public function all(): array
    {
        return Event::with(['cameras', 'genres'])
            ->get()
            ->map(fn ($model) => EventEntity::fromModel($model))
            ->toArray();
    }

    public function update(int $id, EventEntity $event): EventEntity
    {
        $model = Event::findOrFail($id);
        $model->update($event->toArray());

        return EventEntity::fromModel($model);
    }

    public function delete(int $id): bool
    {
        $model = Event::find($id);
        return $model ? $model->delete() : false;
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Event::with('cameras')->paginate($perPage);
    }
}
