<?php

namespace App\Application\UseCases\CameraVideos;

use App\Domain\Repositories\CameraVideoRepositoryInterface;

class DeleteCameraVideoUseCase
{
    public function __construct(
        private CameraVideoRepositoryInterface $videoRepository
    ) {}

    public function execute(int $id): bool
    {
        return $this->videoRepository->delete($id);
    }
}
