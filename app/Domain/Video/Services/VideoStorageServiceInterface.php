<?php

namespace App\Domain\Video\Services;

interface VideoStorageServiceInterface
{
    public function upload($file, string $folder): string;
    public function getSignedUrl(string $path, int $expires): string;
}
