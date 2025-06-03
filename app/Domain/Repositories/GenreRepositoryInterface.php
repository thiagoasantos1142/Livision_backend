<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\GenreEntity;

interface GenreRepositoryInterface
{
    public function findById(int $id): ?GenreEntity;

    public function getAll(): array;

    public function create(GenreEntity $genre): GenreEntity;

    public function update(int $id, GenreEntity $genre): GenreEntity;

    public function delete(int $id): bool;
}
