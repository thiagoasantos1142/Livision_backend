<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class StorageService
{
    public function upload($file, $folder = 'videos')
    {
        $path = $file->store($folder, 's3');
        return $path;
    }

    public function getSignedUrl($path, $expiresInMinutes = 60)
    {
        return Storage::disk('s3')->temporaryUrl(
            $path,
            now()->addMinutes($expiresInMinutes)
        );
    }

    public function getCloudFrontSignedUrl(string $key, int $expiresInMinutes = 60): string
    {
        $expires = now()->addMinutes($expiresInMinutes)->timestamp;

        $cloudFrontUrl = rtrim(config('app.cloudfront_url') ?? env('CLOUDFRONT_URL'), '/') . '/' . ltrim($key, '/');
        $keyPairId = env('CLOUDFRONT_KEY_PAIR_ID');
        $privateKeyPath = env('CLOUDFRONT_PRIVATE_KEY_PATH');

        $resource = $cloudFrontUrl;
        $policy = json_encode([
            'Statement' => [[
                'Resource' => $resource,
                'Condition' => [
                    'DateLessThan' => ['AWS:EpochTime' => $expires],
                ],
            ]],
        ]);

        $signature = $this->rsaSign($policy, $privateKeyPath);
        $base64Policy = strtr(base64_encode($policy), '+/=', '-_~');

        return "$resource?Expires=$expires&Signature=$signature&Key-Pair-Id=$keyPairId";
    }

    private function rsaSign(string $policy, string $privateKeyPath): string
    {
        $privateKey = file_get_contents(base_path($privateKeyPath));
        openssl_sign($policy, $signature, $privateKey, OPENSSL_ALGO_SHA1);
        return strtr(base64_encode($signature), '+/=', '-_~');
    }
}
