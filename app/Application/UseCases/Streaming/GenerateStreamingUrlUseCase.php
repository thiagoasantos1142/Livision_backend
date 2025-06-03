<?php

// app/Application/UseCases/Streaming/GenerateStreamingUrlUseCase.php
namespace App\Application\UseCases\Streaming;

use App\Domain\Services\S3ServiceInterface;

class GenerateStreamingUrlUseCase
{
    public function __construct(private S3ServiceInterface $s3Service)
    {
    }
    
    /**
     * Gera URL para streaming do vídeo.
     *
     * @param string $bucket
     * @param string $key (ex: 'videos/1/show-principal.mp4')
     * @param int $expiration Segundos para expirar a URL
     * @return string
     */
    public function execute(string $bucket, string $key, int $expiration = 3600): string
    {
        return $this->s3Service->generatePresignedDownloadUrl($bucket, $key, $expiration);
    }
}
