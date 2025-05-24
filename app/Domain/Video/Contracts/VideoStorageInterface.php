<?php

namespace App\Domain\Video\Contracts;

interface VideoStorageInterface
{
    public function upload(string $path, mixed $content, string $visibility = 'private'): string;

    public function getSignedUrl(string $path, int $expiresInSeconds = 3600): string;
}
