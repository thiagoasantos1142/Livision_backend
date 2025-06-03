<?php

namespace App\Application\UseCases\Genres;

use App\Domain\Repositories\GenreRepositoryInterface;

class GetAllGenresUseCase
{
    public function __construct(
        private GenreRepositoryInterface $genreRepository
    ) {}

    public function execute(): array
    {
        return $this->genreRepository->getAll();
    }
}
