<?php 

// app/Domain/Services/S3ServiceInterface.php
namespace App\Domain\Services;

interface S3ServiceInterface
{
    /**
     * Gera URL pré-assinada para GET (streaming/download).
     *
     * @param string $bucket
     * @param string $key
     * @param int $expiration Tempo em segundos para expirar a URL
     * @return string URL pré-assinada
     */
    public function generatePresignedDownloadUrl(string $bucket, string $key, int $expiration): string;
}
