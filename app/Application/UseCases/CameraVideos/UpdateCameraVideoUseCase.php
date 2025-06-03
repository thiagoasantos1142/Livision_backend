<?php

namespace App\Application\UseCases\CameraVideos;

use App\Domain\Entities\CameraVideoEntity;
use App\Domain\Repositories\CameraVideoRepositoryInterface;

class UpdateCameraVideoUseCase
{
    public function __construct(
        private CameraVideoRepositoryInterface $videoRepository
    ) {}

    public function execute(int $id, CameraVideoEntity $video): CameraVideoEntity
    {
        return $this->videoRepository->update($id, $video);
    }
}
