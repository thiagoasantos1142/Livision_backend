<?php

namespace App\Application\UseCases\Cameras;

use App\Domain\Entities\CameraEntity;
use App\Domain\Repositories\CameraRepositoryInterface;

class CreateCameraUseCase
{
    public function __construct(
        private CameraRepositoryInterface $cameraRepository
    ) {}

    public function execute(CameraEntity $camera): CameraEntity
    {
        return $this->cameraRepository->create($camera);
    }
}
