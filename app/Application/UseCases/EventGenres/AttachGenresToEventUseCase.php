<?php

namespace App\Application\UseCases\EventGenres;

use App\Application\DTOs\Genres\AttachGenresToEventDTO;
use App\Domain\Repositories\EventGenreRepositoryInterface;

class AttachGenresToEventUseCase
{
    public function __construct(
        private EventGenreRepositoryInterface $repository
    ) {}

    public function execute(AttachGenresToEventDTO $dto): void
    {
        $this->repository->syncGenres($dto->eventId, $dto->genreIds);
    }
}
