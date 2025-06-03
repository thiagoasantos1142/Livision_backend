<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\CameraVideoEntity;
use App\Domain\Repositories\CameraVideoRepositoryInterface;
use App\Application\DTOs\CameraVideos\CameraVideoDTO;


use App\Models\CameraVideo;

class CameraVideoRepository implements CameraVideoRepositoryInterface
{
    public function findById(int $id): ?CameraVideoEntity
    {
        $video = CameraVideo::find($id);
        return $video ? CameraVideoEntity::fromModel($video) : null;
    }

    public function getAllByCamera(int $cameraId): array
    {
        return CameraVideo::where('camera_id', $cameraId)
            ->get()
            ->map(fn($video) => CameraVideoEntity::fromModel($video))
            ->toArray();
    }

    public function create(CameraVideoDTO $dto): CameraVideoEntity
    {
        $model = new CameraVideo();
        $model->camera_id = $dto->cameraId;
        $model->filename = $dto->filename;
        $model->path = $dto->path;
        $model->duration = $dto->duration;
        $model->size = $dto->size;
        $model->recorded_at = $dto->recordedAt;
        $model->save();

        return CameraVideoEntity::fromModel($model);
    }

    public function update(int $id, CameraVideoEntity $video): CameraVideoEntity
    {
        $model = CameraVideo::findOrFail($id);
        $model->update($video->toArray());
        return CameraVideoEntity::fromModel($model);
    }

    public function delete(int $id): bool
    {
        return CameraVideo::destroy($id) > 0;
    }
}
