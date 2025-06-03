<?php

namespace App\Services\CloudFront;

use Illuminate\Support\Facades\Storage;

class CloudFrontSignedUrlService
{
    public function generateSignedUrl(string $path, int $expiresInSeconds = 3600): string
    {
        $cloudFront = Storage::disk('cloudfront');

        return $cloudFront->temporaryUrl(
            $path,
            now()->addSeconds($expiresInSeconds)
        );
    }
}
