<?php

namespace App\Services\Aws;

use Aws\S3\S3Client;
use Illuminate\Support\Facades\Config;

class S3StorageService implements StorageServiceInterface
{
    public function __construct(private S3Client $client) {}

    public function generatePreSignedUploadUrl(string $key): string
    {
        $bucket = Config::get('filesystems.disks.s3.bucket');

        $cmd = $this->client->getCommand('PutObject', [
            'Bucket' => $bucket,
            'Key' => $key,
        ]);

        return (string) $this->client->createPresignedRequest($cmd, '+10 minutes')->getUri();
    }
}