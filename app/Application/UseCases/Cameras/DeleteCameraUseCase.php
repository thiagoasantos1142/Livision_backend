<?php

namespace App\Application\UseCases\Cameras;

use App\Domain\Repositories\CameraRepositoryInterface;

class DeleteCameraUseCase
{
    public function __construct(
        private CameraRepositoryInterface $cameraRepository
    ) {}

    public function execute(int $id): bool
    {
        return $this->cameraRepository->delete($id);
    }
}
