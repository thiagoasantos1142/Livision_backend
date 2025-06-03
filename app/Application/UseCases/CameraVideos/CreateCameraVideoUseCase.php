<?php

namespace App\Application\UseCases\CameraVideos;

use App\Domain\Repositories\CameraRepositoryInterface;
use App\Domain\Repositories\CameraVideoRepositoryInterface;
use App\Domain\Entities\CameraVideo;
use Carbon\Carbon;

class CreateCameraVideoUseCase
{
    public function __construct(
        private CameraRepositoryInterface $cameraRepository,
        private CameraVideoRepositoryInterface $cameraVideoRepository,
    ) {}

    /**
     * Cria um novo registro de vídeo associado à câmera.
     *
     * @param int $cameraId
     * @param string $filename
     * @param string $path
     * @param int|null $duration Segundos (opcional)
     * @param string|null $recordedAt Data/hora gravação (opcional, ISO 8601)
     * @return CameraVideo
     * @throws \Exception
     */
    public function execute(int $cameraId, string $filename, string $path, ?int $duration = null, ?string $recordedAt = null): CameraVideo
    {
        $camera = $this->cameraRepository->findById($cameraId);
        if (!$camera) {
            throw new \Exception('Camera not found');
        }

        // Cria a entidade CameraVideo com construtor ou fromDTO
        $cameraVideo = new CameraVideo(
            id: null, // novo registro
            cameraId: $cameraId,
            filename: $filename,
            path: $path,
            duration: $duration,
            size: $size ?? 0, // tamanho pode ser calculado posteriormente
            recordedAt: $recordedAt ? Carbon::parse($recordedAt) : null,
        );

        // Persiste a entidade via repositório
        $savedVideo = $this->cameraVideoRepository->create($cameraVideo);

        return $savedVideo;
    }

}
