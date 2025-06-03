<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\CameraEntity;
use App\Domain\Repositories\CameraRepositoryInterface;
use App\Application\DTOs\Cameras\CameraDTO;

use App\Models\Camera;

class CameraRepository implements CameraRepositoryInterface
{
    public function findById(int $id): ?CameraEntity
    {
        $camera = Camera::find($id);
        return $camera ? CameraEntity::fromModel($camera) : null;
    }

    public function getAllByEvent(int $eventId): array
    {
        return Camera::where('event_id', $eventId)
            ->get()
            ->map(fn($camera) => CameraEntity::fromModel($camera))
            ->toArray();
    }

    public function create(CameraEntity $cameraEntity): CameraEntity
    {
        // Salva usando o model Eloquent
        $camera = Camera::create([
            'event_id' => $cameraEntity->eventId,
            'label' => $cameraEntity->label,
            'angle' => $cameraEntity->angle,
            'is_live' => $cameraEntity->isLive,
        ]);

        // Retorna a entidade, não o Model
        return new CameraEntity(
            id: $camera->id,
            eventId: $camera->event_id,
            label: $camera->label,
            angle: $camera->angle,
            isLive: $camera->is_live
        );
    }

    public function update(int $id, CameraEntity $camera): CameraEntity
    {
        $model = Camera::findOrFail($id);
        $model->update($camera->toArray());
        return CameraEntity::fromModel($model);
    }

    public function delete(int $id): bool
    {
        return Camera::destroy($id) > 0;
    }
}
