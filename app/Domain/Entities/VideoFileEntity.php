<?php

namespace App\Domain\Entities;

class VideoFileEntity
{
    public function __construct(
        public ?int $id,
        public int $videoId,
        public string $resolution, // e.g. 1080p, 4K
        public string $path,       // S3 or CloudFront URL
        public string $format,     // mp4, hls etc
        public int $size,          // in bytes
        public \DateTimeInterface $createdAt,
        public \DateTimeInterface $updatedAt,
    ) {}
}
