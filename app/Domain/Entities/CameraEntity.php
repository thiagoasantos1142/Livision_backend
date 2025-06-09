<?php

namespace App\Domain\Entities;

use App\Models\Camera;
use App\Application\DTOs\Cameras\CameraDTO;

class CameraEntity
{
  

    public function __construct(
        public ?int $id,
        public int $eventId,
        public string $label,
        public ?string $angle,
        public bool $isLive,
        public array $videos = [],

    ) {}

    public static function fromDTO(CameraDTO $dto): self
    {
        return new self(
            id: null, // ainda não existe, será atribuído após persistência
            eventId: $dto->eventId,
            label: $dto->label,
            angle: $dto->angle,
            isLive: $dto->isLive
        );
    }

    public static function fromModel(Camera $model): self
    {
        return new self(
            id: $model->id,
            eventId: $model->event_id,
            label: $model->label,
            angle: $model->angle,
            isLive: $model->is_live
        );
    }

   

    public function toArray(): array
    {
        return [
            'event_id' => $this->eventId,
            'label' => $this->label,
            'angle' => $this->angle,
            'is_live' => $this->isLive,
        ];
    }


    public function getEventId(): int
    {
        return $this->eventId;
}
}
