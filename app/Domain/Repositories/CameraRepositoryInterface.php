<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\CameraEntity;
use App\Application\DTOs\Cameras\CameraDTO;

interface CameraRepositoryInterface
{
    public function findById(int $id): ?CameraEntity;

    public function getAllByEvent(int $eventId): array;

    public function create(CameraEntity $cameraEntity): CameraEntity;
    /**
     * @param int $id
     * @param CameraEntity $camera
     * @return CameraEntity
     */

    public function update(int $id, CameraEntity $camera): CameraEntity;

    public function delete(int $id): bool;
}
