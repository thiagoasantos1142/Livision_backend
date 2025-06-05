<?php 

namespace App\Domain\Services;

use Illuminate\Support\Facades\Storage;

class StreamingUrlService
{
    public function generateSignedUrl(string $videoPath): string
    {
        return Storage::disk('s3')->temporaryUrl(
            $videoPath,
            now()->addMinutes(30)
        );
    }
}
