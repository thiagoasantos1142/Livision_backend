<?php

namespace App\Application\UseCases\Video;

use App\Domain\Video\Services\VideoStorageServiceInterface;

class GetSignedVideoUrlUseCase
{
    public function __construct(protected VideoStorageServiceInterface $storageService) {}

    public function execute(string $path): string
    {
        return $this->storageService->getSignedUrl($path);
    }
}
