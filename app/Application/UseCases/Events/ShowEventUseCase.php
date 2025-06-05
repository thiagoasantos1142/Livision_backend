<?php 

namespace App\Application\UseCases\Events;

use App\Domain\Repositories\EventRepositoryInterface;
use App\Application\UseCases\Streaming\GenerateStreamingUrlUseCase;

class ShowEventUseCase
{
    public function __construct(
        private EventRepositoryInterface $eventRepository,
        private GenerateStreamingUrlUseCase $streamingUrlUseCase
    ) {}

    public function execute(int $id): array
    {
        $event = $this->eventRepository->find($id);

        if (!$event) {
            throw new \Exception("Event not found.");
        }

        $streamingUrls = [];

        foreach ($event->cameras as $camera) {
            $video = $camera->videos[0] ?? null;

            if ($video && $video->path) {
                $url = $this->streamingUrlUseCase->execute(
                    bucket: 'livision-videos',
                    key: $video->path,
                    expiration: 3600
                );

                $streamingUrls[] = [
                    'camera_id' => $camera->id,
                    'camera_name' => $camera->name,
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
