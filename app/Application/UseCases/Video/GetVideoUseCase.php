<?php

namespace App\Application\UseCases\Video;

use App\Domain\Repositories\VideoRepositoryInterface;

class GetVideoUseCase
{
    public function __construct(private VideoRepositoryInterface $repository) {}

    public function execute(int $id)
    {
        return $this->repository->find($id);
    }
}
