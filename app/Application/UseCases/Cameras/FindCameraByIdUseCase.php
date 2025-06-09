<?php

namespace App\Application\UseCases\Cameras;

use App\Domain\Repositories\CameraRepositoryInterface;

class FindCameraByIdUseCase
{
    public function __construct(
        private CameraRepositoryInterface $cameraRepository
    ) {}

    public function execute(int $id): CameraEntity|null
    {
        return $this->cameraRepository->findById($id);
    }
}
