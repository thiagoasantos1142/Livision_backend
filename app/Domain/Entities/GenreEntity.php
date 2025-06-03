<?php

namespace App\Domain\Entities;

use App\Models\Genre;

class GenreEntity
{
    public function __construct(
        public ?int $id,
        public string $name,
        
    ) {}

    public static function fromModel(Genre $model): self
    {
        return new self(
            id: $model->id,
            name: $model->name,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
