<?php

namespace App\Application\UseCases\Genres;

use App\Domain\Repositories\GenreRepositoryInterface;

class DeleteGenreUseCase
{
    public function __construct(
        private GenreRepositoryInterface $genreRepository
    ) {}

    public function execute(int $id): bool
    {
        return $this->genreRepository->delete($id);
    }
}
