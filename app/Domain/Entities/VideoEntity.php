<?php

namespace App\Domain\Entities;

class VideoEntity
{
    public function __construct(
        public ?int $id,
        public string $title,
        public ?string $description,
        public string $type,
        public string $rating,
        public ?int $yearLaunched,
        public ?int $duration,
        public bool $isOpen,
        public bool $published,
        public ?int $seasonId,
        public ?int $episodeNumber,
        public ?\DateTimeInterface $createdAt,
        public ?\DateTimeInterface $updatedAt
    ) {}
}
