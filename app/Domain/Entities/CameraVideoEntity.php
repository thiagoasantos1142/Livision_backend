<?php

namespace App\Domain\Entities;

use App\Models\CameraVideo;

class CameraVideoEntity
{
   public function __construct(
        public ?int $id,
        public int $cameraId,
        public string $filename,
        public string $path,
        public ?int $duration,
        public ?string $recordedAt,
        public ?string $quality,
        public ?string $mimeType,
        public ?int $size,
        public ?string $status
    ) {}    

      public static function fromModel(CameraVideo $model): self
    {
        return new self(
            id: $model->id,
            cameraId: $model->camera_id,
            filename: $model->filename,
            path: $model->path,
            duration: $model->duration,
            recordedAt: optional($model->recorded_at)?->toDateTimeString(),
            quality: $model->quality,
            mimeType: $model->mime_type,
            size: $model->size,
            status: $model->status
        );
    }

    public function toArray(): array
    {
        return [
            'camera_id' => $this->cameraId,
            'filename' => $this->filename,
            'path' => $this->path,
            'duration' => $this->duration,
            'recorded_at' => $this->recordedAt,
            'quality' => $this->quality,
            'mime_type' => $this->mimeType,
            'size' => $this->size,
            'status' => $this->status,
        ];
    }
}
