<?php

namespace App\Application\DTOs\Genres;

class AttachGenresToEventDTO
{
    public function __construct(
        public int $eventId,
        public array $genreIds // array de IDs de gêneros
    ) {}
}
