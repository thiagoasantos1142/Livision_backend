<?php

namespace App\Application\UseCases\Video;

use App\Domain\Repositories\VideoRepositoryInterface;
use App\Domain\Entities\VideoEntity;

class CreateVideoUseCase
{
    public function __construct(
            private VideoRepositoryInterface $repository,
            private UploadVideoUseCase $uploadUseCase
        ) {}

    public function execute(array $data, UploadedFile $file): array
    {
        // Define valores padrão se não estiverem definidos
        $data['is_open'] = $data['is_open'] ?? false;
        $data['published'] = $data['published'] ?? false;

        /** @var VideoEntity $videoEntity */
        $videoEntity = $this->repository->create($data);

        
         // Faz o upload
        $this->uploadUseCase->execute($videoEntity->id, $file);
        // Converte o VideoEntity em array para retornar
        return [
            'id' => $videoEntity->id,
            'title' => $videoEntity->title,
            'description' => $videoEntity->description,
            'type' => $videoEntity->type,
            'rating' => $videoEntity->rating,
            'year_launched' => $videoEntity->yearLaunched,
            'duration' => $videoEntity->duration,
            'is_open' => $videoEntity->isOpen,
            'published' => $videoEntity->published,
            'season_id' => $videoEntity->seasonId,
            'episode_number' => $videoEntity->episodeNumber,
            'created_at' => $videoEntity->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $videoEntity->updatedAt?->format('Y-m-d H:i:s'),
            'message' => 'Vídeo criado e upload realizado com sucesso'

        ];
    }
}
