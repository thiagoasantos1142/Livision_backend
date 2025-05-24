<?php

namespace App\Application\UseCases\Video;

use App\Domain\Repositories\VideoRepositoryInterface;

class ListVideosUseCase
{
    public function __construct(private VideoRepositoryInterface $repository) {}

    public function execute(): array
    {
        return $this->repository->all();
    }
}
