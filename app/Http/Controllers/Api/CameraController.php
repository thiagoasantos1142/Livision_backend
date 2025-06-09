<?php

namespace App\Http\Controllers\Api;

use App\Application\DTOs\Cameras\CameraDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Application\UseCases\Cameras\CreateCameraUseCase;
use App\Application\UseCases\Cameras\DeleteCameraUseCase;
use App\Application\UseCases\Cameras\FindCameraByIdUseCase;
use App\Application\UseCases\Cameras\GetAllCamerasUseCase;
use App\Application\UseCases\Cameras\UpdateCameraUseCase;
use App\Application\UseCases\Uploads\InitiateUploadUseCase;
use App\Http\Requests\CameraRequest;
use App\Http\Resources\CameraResource;
use Illuminate\Routing\Controller;

class CameraController extends Controller
{
    public function __construct(
        private GetAllCamerasUseCase $getAllCameras,
        private FindCameraByIdUseCase $findCameraById,
        private CreateCameraUseCase $createCamera,
        private UpdateCameraUseCase $updateCamera,
        private DeleteCameraUseCase $deleteCamera,
        private InitiateUploadUseCase $initiateUploadUseCase,
    ) {}

    public function index()
    {
        $cameras = $this->getAllCameras->execute();
        return CameraResource::collection($cameras);
    }

    public function show(int $id)
    {
        $camera = $this->findCameraById->execute($id);
        if (!$camera) {
            return response()->json(['message' => 'Camera not found'], 404);
        }
        return new CameraResource($camera);
    }

    public function createWithUploadUrl(Request $request, int $eventId): JsonResponse
    {
        $request->validate([
            'label' => 'required|string',
            'filename' => 'required|string'
        ]);

        try {
            $data = $this->initiateUploadUseCase->execute(
                $eventId,
                $request->input('label'),
                $request->input('filename')
            );

            return response()->json($data);
        } catch (\Throwable $e) {
            Log::error('Erro ao criar câmera com upload', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Erro ao criar câmera com upload.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function update(CameraRequest $request, int $id)
    {
      $cameraDTO = new CameraDTO($eventId, $label, null, true);
        $camera = $this->updateCamera->execute($id, $cameraDTO);
        return new CameraResource($camera);
    }

    public function destroyFromEvent(int $eventId, int $cameraId)
    {
        // (Opcional) Valide se a câmera pertence ao evento informado
        $camera = $this->findCameraById->execute($cameraId);

        if (!$camera || $camera->event_id !== $eventId) {
            return response()->json(['error' => 'Camera not found for this event.'], 404);
        }

        $this->deleteCamera->execute($cameraId);

        return response()->json(['message' => 'Camera deleted successfully.'], 204);
    }

}
