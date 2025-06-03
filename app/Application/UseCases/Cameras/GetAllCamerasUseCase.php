<?php

namespace App\Application\UseCases\Cameras;

use App\Domain\Repositories\CameraRepositoryInterface;

class GetAllCamerasUseCase
{
    public function __construct(
        protected CameraRepositoryInterface $cameraRepository
    ) {}

    public function execute(): array
    {
        return $cameraRepository->all();
    }
}
