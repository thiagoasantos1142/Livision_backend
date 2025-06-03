<?php

namespace App\Infrastructure\Services;

use Aws\S3\S3Client;
use App\Domain\Services\S3ServiceInterface;
use App\Application\UseCases\Uploads\GenerateUploadUrlUseCase;
use App\Application\UseCases\Uploads\InitiateUploadUseCase;

class AwsS3Service implements S3ServiceInterface
{
    public function __construct(
        private S3Client $s3Client,
        private string $bucketName,
    ) {}

    /**
     * Gera URL pré-assinada para upload (PutObject).
     *
     * @param string $key Caminho/chave do objeto no bucket
     * @param int $expiration Tempo em segundos para expirar a URL
     * @param string $contentType Tipo MIME do arquivo (ex: video/mp4)
     * @return string URL pré-assinada
     */
    public function generatePresignedUploadUrl(string $key, int $expiration, string $contentType = 'video/mp4'): string
    {
        $cmd = $this->s3Client->getCommand('PutObject', [
            'Bucket' => $this->bucketName,
            'Key' => $key,
            'ACL' => 'private',
            'ContentType' => $contentType,
        ]);

        $request = $this->s3Client->createPresignedRequest($cmd, '+' . $expiration . ' seconds');

        return (string) $request->getUri();
    }

    public function generatePresignedDownloadUrl(string $bucket, string $key, int $expiration): string
    {
        $cmd = $this->s3Client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key' => $key,
        ]);

        $request = $this->s3Client->createPresignedRequest($cmd, "+{$expiration} seconds");

        return (string) $request->getUri();
    }

}
