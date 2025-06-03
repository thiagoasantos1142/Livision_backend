<?php

namespace App\Application\UseCases\Uploads;

use App\Infrastructure\Services\AwsS3Service;

class GenerateUploadUrlUseCase
{
    public function __construct(
        private AwsS3Service $awsS3Service,
        private string $bucketName
    ) {}

    public function execute(int $cameraId, string $filename): string
    {
        // usa AwsS3Service para gerar URL assinada
        return $this->awsS3Service->generatePresignedUrl($this->bucketName, $filename);
    }
}
