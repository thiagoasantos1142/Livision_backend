<?php

namespace App\Application\UseCases\Video;

use App\Domain\Video\Contracts\VideoStorageInterface;

class GenerateSignedUrlUseCase
{
    public function __construct(
        protected VideoStorageInterface $storage
    ) {}

    public function handle(string $path, int $expires = 3600): string
    {
        return $this->storage->getSignedUrl($path, $expires);
    }
}
