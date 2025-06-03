<?php

namespace App\Http\Controllers\Api;

use App\Application\DTOs\Cameras\CameraDTO;
use App\Application\UseCases\Cameras\CreateCameraUseCase;
use App\Application\UseCases\Cameras\DeleteCameraUseCase;
use App\Application\UseCases\Cameras\FindCameraByIdUseCase;
use App\Application\UseCases\Cameras\GetAllCamerasUseCase;
use App\Application\UseCases\Cameras\UpdateCameraUseCase;
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

    public function store(CameraRequest $request)
    {
       $cameraDTO = new CameraDTO($eventId, $label, null, true);

        $camera = $this->createCamera->execute($cameraDTO);
        return new CameraResource($camera);
    }

    public function update(CameraRequest $request, int $id)
    {
      $cameraDTO = new CameraDTO($eventId, $label, null, true);
        $camera = $this->updateCamera->execute($id, $cameraDTO);
        return new CameraResource($camera);
    }

    public function destroy(int $id)
    {
        $this->deleteCamera->execute($id);
        return response()->json([], 204);
    }
}
