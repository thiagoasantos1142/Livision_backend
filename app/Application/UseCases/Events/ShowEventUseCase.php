<?php 

namespace App\Application\UseCases\Events;

use App\Domain\Repositories\EventRepositoryInterface;
use App\Application\UseCases\Streaming\GenerateStreamingUrlUseCase;

class ShowEventUseCase
{
    public function __construct(
        private EventRepositoryInterface $eventRepository,
        private GenerateStreamingUrlUseCase $generateStreamingUrl,

        private GenerateStreamingUrlUseCase $streamingUrlUseCase
    ) {}

    public function execute(int $id): array
    {
        $event = $this->eventRepository->findByIdWithCamerasAndVideos($id);
        // Verifica se o evento foi encontrado
        if (!$event) {
            throw new \Exception("Event not found.");
        }

        $streamingUrls = [];

       foreach ($event->cameras as $camera) {
            foreach ($camera->videos ?? [] as $video) {
                // Exemplo: videos/5/camera-1.mp4
                $key = $video->path;
                $url = $this->generateStreamingUrl->execute('livision-videos', $key);
                $streamingUrls[] = [
                    'camera_id' => $camera->id,
                    'url' => $url,
                ];
            }
        }

        return [
            'event' => $event,
            'streaming_urls' => $streamingUrls,
        ];
    }
}
