<?php

namespace App\Domain\Entities;

use App\Models\Event;

class EventEntity
{
    public function __construct(
        public ?int $id,
        public string $title,
        public string $slug,
        public ?string $description,
        public string $format, // live ou recorded
        public int $eventTypeId,
        public int $eventCategoryId,
        public ?string $start_time,
        public ?string $end_time,
        public bool $is_open,
        public bool $published,
        public ?string $thumbnail = null,
        public ?string $location = null,
        public ?string $general_info = null,
        public ?array $participants = [],
        public ?array $cameras,
        public ?string $created_at = null,
        public ?string $updated_at = null,
    ) {}

    public static function fromModel(Event $model): self
    {
        return new self(
            id: $model->id,
            title: $model->title,
            slug: $model->slug,
            description: $model->description,
            format: $model->format,
            eventTypeId: $model->event_type_id,
            eventCategoryId: $model->event_category_id,
            start_time: $model->start_time,
            end_time: $model->end_time,
            is_open: $model->is_open,
            published: $model->published,
            location: $model->location,
            thumbnail: $model->thumbnail,
            general_info: $model->general_info,
            cameras: $model->cameras
                ? $model->cameras->map(fn ($c) => CameraEntity::fromModel($c))->toArray()
                : null,

            participants: $model->participants
                ? $model->participants->map(fn ($p) => new ParticipantEntity(
                    id: $p->participant_id,
                    name: $p->participant->name ?? '',
                    type: $p->participant->type ?? '',
                    role: $p->role
                ))->toArray()
                : null,

            created_at: optional($model->created_at)?->toDateTimeString(),
            updated_at: optional($model->updated_at)?->toDateTimeString(),
        );
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'format' => $this->format,
            'event_type_id' => $this->eventTypeId,
            'event_category_id' => $this->eventCategoryId,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'is_open' => $this->is_open,
            'published' => $this->published,
            'thumbnail' => $this->thumbnail,
            'location' => $this->location,
            'general_info' => $this->general_info,
            'participants' => ParticipantResource::collection($this->participants),
            'cameras' => $this->cameras ? array_map(fn($camera) => [
                'id' => $camera['id'],
                'label' => $camera['label'],
                'video_path' => $camera['video_path'] ?? null,
            ], $this->cameras) : [],
        ];
    }
}
