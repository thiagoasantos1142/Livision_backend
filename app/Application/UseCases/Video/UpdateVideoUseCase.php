<?php

namespace App\Application\UseCases\Video;

use App\Domain\Repositories\VideoRepositoryInterface;

class UpdateVideoUseCase
{
    public function __construct(private VideoRepositoryInterface $repository) {}

    public function execute(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }
}
