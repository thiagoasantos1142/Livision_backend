<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CameraResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'event_id' => $this->event_id,
            'label' => $this->label,
            'angle' => $this->angle,
            'is_live' => $this->is_live,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
