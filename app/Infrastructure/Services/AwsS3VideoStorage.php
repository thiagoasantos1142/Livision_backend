<?php 

namespace App\Infrastructure\Services;

use App\Domain\Video\Contracts\VideoStorageInterface;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AwsS3VideoStorage implements VideoStorageInterface
{
    public function upload(string $path, mixed $content, string $visibility = 'private'): string
    {
        Storage::disk('s3')->put($path, $content, $visibility);
        return $path;
    }

    public function getSignedUrl(string $path, int $expiresInSeconds = 3600): string
    {
        $expires = Carbon::now()->addSeconds($expiresInSeconds);
        return Storage::disk('s3')->temporaryUrl($path, $expires);
    }
}
