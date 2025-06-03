<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\EventGenreRepositoryInterface;
use App\Models\Event;

class EventGenreRepository implements EventGenreRepositoryInterface
{
    public function attachGenres(int $eventId, array $genreIds): void
    {
        $event = Event::findOrFail($eventId);
        $event->genres()->attach($genreIds);
    }

    public function syncGenres(int $eventId, array $genreIds): void
    {
        $event = Event::findOrFail($eventId);
        $event->genres()->sync($genreIds);
    }

    public function detachAll(int $eventId): void
    {
        $event = Event::findOrFail($eventId);
        $event->genres()->detach();
    }

    public function getGenreIdsByEvent(int $eventId): array
    {
        $event = Event::findOrFail($eventId);
        return $event->genres()->pluck('genres.id')->toArray();
    }
}
