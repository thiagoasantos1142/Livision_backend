<?php

namespace App\Application\UseCases\CameraVideos;

use App\Domain\Repositories\CameraVideoRepositoryInterface;

class GetCameraVideosByCameraUseCase
{
    public function __construct(
        private CameraVideoRepositoryInterface $videoRepository
    ) {}

    public function execute(int $cameraId): array
    {
        return $this->videoRepository->getAllByCamera($cameraId);
    }
}
