<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CameraVideoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'camera_id' => $this->camera_id,
            'filename' => $this->filename,
            'path' => $this->path,
            'duration' => $this->duration,
            'recorded_at' => $this->recorded_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
