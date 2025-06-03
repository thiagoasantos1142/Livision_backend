<?php

namespace App\Application\UseCases\CameraVideos;

use App\Domain\Repositories\CameraVideoRepositoryInterface;

class FindCameraVideoByIdUseCase
{
    public function __construct(
        private CameraVideoRepositoryInterface $videoRepository
    ) {}

    public function execute(int $id)
    {
        return $this->videoRepository->findById($id);
    }
}
