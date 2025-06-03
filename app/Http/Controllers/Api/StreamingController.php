<?php

// app/Http/Controllers/Api/StreamingController.php
namespace App\Http\Controllers\Api;

use App\Application\UseCases\Streaming\GenerateStreamingUrlUseCase;
use Illuminate\Http\Request;

class StreamingController
{
    public function __construct(private GenerateStreamingUrlUseCase $useCase) {}

    public function getStreamingUrl(Request $request)
    {
        $bucket = 'livision-videos';
        $key = $request->input('key'); // ex: videos/1/show-principal.mp4
        $expiration = (int) $request->input('expiration', 3600);

        $url = $this->useCase->execute($bucket, $key, $expiration);

        return response()->json(['streaming_url' => $url]);
    }
}
