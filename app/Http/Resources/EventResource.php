<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'category_id' => $this->categoryId,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'is_open' => $this->is_open,
            'published' => $this->published,
            'cameras' => !empty($this->cameras) 
                ? CameraResource::collection($this->cameras) 
                : null,

        ];
    }
}
