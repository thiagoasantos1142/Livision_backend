<?php

namespace App\Http\Controllers\Api;

use App\Application\DTOs\CameraVideos\CameraVideoDTO;
use App\Application\UseCases\CameraVideos\CreateCameraVideoUseCase;
use App\Application\UseCases\CameraVideos\DeleteCameraVideoUseCase;
use App\Application\UseCases\CameraVideos\FindCameraVideoByIdUseCase;
use App\Application\UseCases\CameraVideos\GetAllCameraVideosUseCase;
use App\Application\UseCases\CameraVideos\UpdateCameraVideoUseCase;
use App\Application\UseCases\Uploads\InitiateUploadUseCase;

use App\Http\Requests\CameraVideoRequest;
use App\Http\Resources\CameraVideoResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class CameraVideoController extends Controller
{
    public function __construct(
        private GetAllCameraVideosUseCase $getAllCameraVideos,
        private FindCameraVideoByIdUseCase $findCameraVideoById,
        private CreateCameraVideoUseCase $createCameraVideo,
        private UpdateCameraVideoUseCase $updateCameraVideo,
        private DeleteCameraVideoUseCase $deleteCameraVideo,
        private InitiateUploadUseCase $initiateUploadUseCase,


    ) {}

    public function index()
    {
        $videos = $this->getAllCameraVideos->execute();
        return CameraVideoResource::collection($videos);
    }

    public function show(int $id)
    {
        $video = $this->findCameraVideoById->execute($id);
        if (!$video) {
            return response()->json(['message' => 'CameraVideo not found'], 404);
        }
        return new CameraVideoResource($video);
    }

    public function store(CameraVideoRequest $request)
    {
        try {
            $dto = new CameraVideoDTO(
                id: null,
                cameraId: $request->camera_id,
                filename: $request->filename,
                path: $request->path,
                duration: $request->duration,
                size: $request->size,
                recordedAt: $request->recorded_at
            );

            $video = $this->createCameraVideo->execute($dto);
            Log::info('Video criado', ['video' => $video]);
            return new CameraVideoResource($video);
        } catch (\Throwable $e) {
            Log::error('Erro no store de CameraVideo: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao criar vídeo'], 500);
        }
    }


    public function update(CameraVideoRequest $request, int $id)
    {
        $dto = new CameraVideoDTO(
            id: null,
            cameraId: $request->camera_id,
            filename: $request->filename,
            path: $request->path,
            duration: $request->duration,
            recordedAt: $request->recorded_at
        );

        $video = $this->updateCameraVideo->execute($id, $dto);
        return new CameraVideoResource($video);
    }

    public function destroy(int $id)
    {
        $this->deleteCameraVideo->execute($id);
        return response()->json([], 204);
    }
}
