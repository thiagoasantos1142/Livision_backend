<?php

namespace App\Application\UseCases\Cameras;

use App\Domain\Entities\CameraEntity;
use App\Domain\Repositories\CameraRepositoryInterface;

class UpdateCameraUseCase
{
    public function __construct(
        private CameraRepositoryInterface $cameraRepository
    ) {}

    public function execute(int $id, CameraEntity $camera): CameraEntity
    {
        return $this->cameraRepository->update($id, $camera);
    }
}
