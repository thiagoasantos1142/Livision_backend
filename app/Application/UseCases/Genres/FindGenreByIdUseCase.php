<?php

namespace App\Application\UseCases\Genres;

use App\Domain\Repositories\GenreRepositoryInterface;

class FindGenreByIdUseCase
{
    public function __construct(
        private GenreRepositoryInterface $genreRepository
    ) {}

    public function execute(int $id)
    {
        return $this->genreRepository->findById($id);
    }
}
