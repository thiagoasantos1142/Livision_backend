<?php

namespace App\Domain\Entities;

use App\Models\CameraVideo;

class CameraVideoEntity
{
    public function __construct(
        public ?int $id,
        public int $camera_id,
        public string $filename,
        public string $path,
        public ?int $duration,
        public ?string $recorded_at,
    ) {}

    public static function fromModel(CameraVideo $model): self
    {
        return new self(
            id: $model->id,
            camera_id: $model->camera_id,
            filename: $model->filename,
            path: $model->path,
            duration: $model->duration,
            recorded_at: optional($model->recorded_at)?->toDateTimeString()
        );
    }

    public function toArray(): array
    {
        return [
            'camera_id' => $this->camera_id,
            'filename' => $this->filename,
            'path' => $this->path,
            'duration' => $this->duration,
            'recorded_at' => $this->recorded_at,
        ];
    }
}
