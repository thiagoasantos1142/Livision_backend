<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\GenreEntity;
use App\Domain\Repositories\GenreRepositoryInterface;
use App\Models\Genre;

class GenreRepository implements GenreRepositoryInterface
{
    public function findById(int $id): ?GenreEntity
    {
        $genre = Genre::find($id);
        return $genre ? GenreEntity::fromModel($genre) : null;
    }

    public function getAll(): array
    {
        return Genre::all()
            ->map(fn($genre) => GenreEntity::fromModel($genre))
            ->toArray();
    }

    public function create(GenreEntity $genre): GenreEntity
    {
        $model = Genre::create($genre->toArray());
        return GenreEntity::fromModel($model);
    }

    public function update(int $id, GenreEntity $genre): GenreEntity
    {
        $model = Genre::findOrFail($id);
        $model->update($genre->toArray());
        return GenreEntity::fromModel($model);
    }

    public function delete(int $id): bool
    {
        return Genre::destroy($id) > 0;
    }
}
