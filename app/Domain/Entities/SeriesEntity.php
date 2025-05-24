<?php

namespace App\Domain\Entities;

class SeriesEntity
{
    public function __construct(
        public ?int $id,
        public string $title,
        public string $description,
        public ?string $slug,
        public \DateTimeInterface $createdAt,
        public \DateTimeInterface $updatedAt,
    ) {}
}
