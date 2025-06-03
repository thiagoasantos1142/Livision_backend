<?php

namespace App\Application\UseCases\Genres;

use App\Domain\Entities\GenreEntity;
use App\Domain\Repositories\GenreRepositoryInterface;

class UpdateGenreUseCase
{
    public function __construct(
        private GenreRepositoryInterface $genreRepository
    ) {}

    public function execute(int $id, GenreEntity $genre): GenreEntity
    {
        return $this->genreRepository->update($id, $genre);
    }
}
