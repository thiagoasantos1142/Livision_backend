<?php

namespace App\Application\DTOs\Cameras;

use App\Domain\Entities\CameraEntity;

class CameraDTO
{
    public function __construct(
        public int $eventId,
        public string $label,
        public ?string $angle = null,
        public bool $isLive = false
    ) {}

    public static function fromEntity(CameraEntity $entity): self
    {
        return new self(
            eventId: $entity->eventId,
            label: $entity->label,
            angle: $entity->angle,
            isLive: $entity->isLive
        );
    }
}
