<?php

namespace App\Application\UseCases\CameraVideos;

use App\Domain\Repositories\CameraVideoRepositoryInterface;

class GetAllCameraVideosUseCase
{
    public function __construct(
        protected CameraVideoRepositoryInterface $cameraVideoRepository
    ) {}

    public function execute(): array
    {
        return $this->cameraVideoRepository->all();
    }
}
