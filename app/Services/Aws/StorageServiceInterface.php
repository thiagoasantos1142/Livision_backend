<?php
namespace App\Services\Aws;

interface StorageServiceInterface
{
    public function generatePreSignedUploadUrl(string $key): string;
}