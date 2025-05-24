<?php

namespace App\Domain\Entities;

class SeasonEntity
{
    public function __construct(
        public ?int $id,
        public int $seriesId,
        public int $seasonNumber,
        public string $title,
        public \DateTimeInterface $createdAt,
        public \DateTimeInterface $updatedAt,
    ) {}
}
