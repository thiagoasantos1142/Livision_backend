<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\CameraVideoEntity;
use App\Application\DTOs\CameraVideos\CameraVideoDTO;
// Interface for Camera Video Repository

interface CameraVideoRepositoryInterface
{
    public function findById(int $id): ?CameraVideoEntity;

    public function getAllByCamera(int $cameraId): array;

    public function create(CameraVideoDTO $dto): CameraVideoEntity;

    public function update(int $id, CameraVideoEntity $video): CameraVideoEntity;

    public function delete(int $id): bool;
}
