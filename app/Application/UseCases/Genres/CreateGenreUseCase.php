<?php

namespace App\Application\UseCases\Genres;

use App\Domain\Entities\GenreEntity;
use App\Domain\Repositories\GenreRepositoryInterface;

class CreateGenreUseCase
{
    public function __construct(
        private GenreRepositoryInterface $genreRepository
    ) {}

    public function execute(GenreEntity $genre): GenreEntity
    {
        return $this->genreRepository->create($genre);
    }
}
