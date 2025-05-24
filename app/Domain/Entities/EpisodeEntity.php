<?php

namespace App\Domain\Entities;

class EpisodeEntity
{
    public function __construct(
        public ?int $id,
        public int $seasonId,
        public int $episodeNumber,
        public string $title,
        public string $description,
        public ?string $slug,
        public \DateTimeInterface $releasedAt,
        public \DateTimeInterface $createdAt,
        public \DateTimeInterface $updatedAt,
    ) {}
}
