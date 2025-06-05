<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,                 // id do participante
            'name' => $this->name,             // nome
            'type' => $this->type ?? null,    // tipo (pode ser null)
            'event_id' => $this->event_id,     // id do evento associado
            'created_at' => $this->created_at, // data de criação];
            'updated_at' => $this->updated_at, // data de atualização
            'role' => $this->role,             // papel do participante no evento
        ];
    }
}
