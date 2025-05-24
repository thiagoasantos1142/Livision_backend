<?php

namespace App\Infrastructure\Storage;

use App\Domain\Video\Services\VideoStorageServiceInterface;
use Illuminate\Support\Facades\Storage;

class S3VideoStorageService implements VideoStorageServiceInterface
{
    public function upload($file, string $folder): string
    {
        return $file->store($folder, 's3');
    }

    public function getSignedUrl(string $path, int $expires = 60): string
    {
        $url = rtrim(env('CLOUDFRONT_URL'), '/') . '/' . ltrim($path, '/');
        $expiresAt = now()->addMinutes($expires)->timestamp;

        $policy = json_encode([
            'Statement' => [[
                'Resource' => $url,
                'Condition' => [
                    'DateLessThan' => ['AWS:EpochTime' => $expiresAt],
                ],
            ]],
        ]);

        $signature = $this->rsaSign($policy);
        $encodedPolicy = strtr(base64_encode($policy), '+/=', '-_~');

        return "$url?Expires=$expiresAt&Signature=$signature&Key-Pair-Id=" . env('CLOUDFRONT_KEY_PAIR_ID');
    }

    private function rsaSign(string $policy): string
    {
        $privateKey = file_get_contents(base_path(env('CLOUDFRONT_PRIVATE_KEY_PATH')));
        openssl_sign($policy, $signature, $privateKey, OPENSSL_ALGO_SHA1);
        return strtr(base64_encode($signature), '+/=', '-_~');
    }
}
