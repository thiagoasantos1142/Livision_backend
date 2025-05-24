<?php

namespace App\Application\UseCases\Video;

use App\Domain\Repositories\VideoRepositoryInterface;

class DeleteVideoUseCase
{
    public function __construct(private VideoRepositoryInterface $repository) {}

    public function execute(int $id): void
    {
        $this->repository->delete($id);
    }
}
