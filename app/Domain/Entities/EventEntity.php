<?php

namespace App\Domain\Entities;

use App\Models\Event;

class EventEntity
{
    public function __construct(
        public ?int $id,
        public string $title,
        public ?string $description,
        public string $type,
        public ?int $categoryId,
        public ?string $start_time,
        public ?string $end_time,
        public bool $is_open,
        public bool $published,
        
        public ?string $created_at = null,
        public ?string $updated_at = null,
    ) {}

    public static function fromModel(Event $model): self
    {
        return new self(
            id: $model->id,
            title: $model->title,
            description: $model->description,
            type: $model->type,
            categoryId: $model->category_id,
            start_time: optional($model->start_time)?->toDateTimeString(),
            end_time: optional($model->end_time)?->toDateTimeString(),
            is_open: $model->is_open,
            published: $model->published,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'category_id' => $this->categoryId,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'is_open' => $this->is_open,
            'published' => $this->published,
        ];
    }
}
