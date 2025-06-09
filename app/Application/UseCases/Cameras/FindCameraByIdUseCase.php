<?php

namespace App\Application\UseCases\Cameras;

use App\Domain\Entities\CameraEntity;
use App\Domain\Repositories\CameraRepositoryInterface;

class FindCameraByIdUseCase
{
    public function __construct(
        private CameraRepositoryInterface $cameraRepository
    ) {}

    public function execute(int $id): ?CameraEntity
    {
        return $this->cameraRepository->findById($id);
    }
}

