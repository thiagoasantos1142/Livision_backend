<?php
namespace App\Application\UseCases\Uploads;

use App\Application\DTOs\Cameras\CameraDTO;
use App\Application\DTOs\CameraVideos\CameraVideoDTO;
use App\Domain\Repositories\CameraRepositoryInterface;
use App\Domain\Repositories\CameraVideoRepositoryInterface;
use App\Infrastructure\Services\AwsS3Service;
use App\Domain\Entities\CameraEntity;
use App\Domain\Entities\CameraVideoEntity;

class InitiateUploadUseCase
{
    public function __construct(
        private AwsS3Service $awsS3Service,
        private CameraRepositoryInterface $cameraRepository,
        private CameraVideoRepositoryInterface $cameraVideoRepository,
        private string $bucketName
    ) {}

    public function execute(int $eventId, string $label, string $filename): array
    {
        try {
            $cameraDTO = new CameraDTO(
                eventId: $eventId,
                label: $label,
                angle: null,
                isLive: true
            );

            // CONVERTE o DTO em entidade
            $cameraEntity = CameraEntity::fromDTO($cameraDTO);

            // AGORA sim passa a entidade
            $camera = $this->cameraRepository->create($cameraEntity);


            if (!$camera) {
                throw new \RuntimeException('Falha ao criar câmera');
            }

            $path = "videos/{$eventId}/{$filename}";

            $uploadUrl = $this->awsS3Service->generatePresignedUploadUrl(
                key: $path,
                expiration: 3600,
                contentType: 'video/mp4'
            );


            $cameraVideoDTO = new CameraVideoDTO(
                id: null, // ainda não existe, será atribuído após persistência
                cameraId: $camera->id,
                filename: $filename,
                path: $path,
                duration: null,
                size: $size ?? 0, 
                recordedAt: null
            );

            $video = $this->cameraVideoRepository->create($cameraVideoDTO);

            return [
                'upload_url' => $uploadUrl,
                'camera_id' => $camera->id,
                'camera_video_id' => $video->id,
            ];
        } catch (\Exception $e) {
            throw new \RuntimeException('Falha ao iniciar upload: ' . $e->getMessage());
        }
    }

}
