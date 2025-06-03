<?php 

namespace App\Application\DTOs\CameraVideos;

class CameraVideoDTO
{
    public function __construct(
        public ?int $id = null,
        public int $cameraId,
        public string $filename,
        public string $path,
        public ?int $duration = null,
        public int $size,
        public ?string $recordedAt = null,
    ) {}
}
