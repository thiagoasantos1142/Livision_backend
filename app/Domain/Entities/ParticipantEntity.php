<?php

namespace App\Domain\Entities;

class ParticipantEntity
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $type,
        public ?int $event_id = null,
        public ?string $created_at = null,
        public ?string $updated_at = null,
         public ?string $role = null, 
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'event_id' => $this->event_id,
        ];
    }
}
