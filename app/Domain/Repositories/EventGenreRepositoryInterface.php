<?php

namespace App\Domain\Repositories;

interface EventGenreRepositoryInterface
{
    public function attachGenres(int $eventId, array $genreIds): void;

    public function syncGenres(int $eventId, array $genreIds): void;

    public function detachAll(int $eventId): void;

    public function getGenreIdsByEvent(int $eventId): array;
}
