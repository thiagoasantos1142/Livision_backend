<?php

namespace App\Http\Controllers\Api;

use App\Application\UseCases\Uploads\InitiateUploadUseCase;
use App\Http\Requests\InitiateUploadRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class UploadController extends Controller
{
    public function __construct(
        private readonly InitiateUploadUseCase $initiateUploadUseCase
    ) {}

    public function initiateUpload(InitiateUploadRequest $request): JsonResponse
    {
        try {
            $data = $this->initiateUploadUseCase->execute(
                $request->validated('event_id'),
                $request->validated('label'),
                $request->validated('filename')
            );

            return response()->json($data);
        } catch (\Throwable $e) {
            Log::error('Erro ao iniciar upload', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Erro ao iniciar upload.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
