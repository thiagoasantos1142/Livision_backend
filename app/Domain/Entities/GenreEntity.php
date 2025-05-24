<?php

namespace App\Domain\Entities;

class GenreEntity
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $slug,
        public \DateTimeInterface $createdAt,
        public \DateTimeInterface $updatedAt,
    ) {}
}
