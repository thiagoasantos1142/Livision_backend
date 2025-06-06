<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\EventTypeResource;
use App\Http\Resources\EventCategoryResource;
use App\Http\Resources\CameraResource;
use App\Http\Resources\ParticipantResource;


class EventResource extends JsonResource
{
    /**
     * Transforma o recurso em array para JSON.
     *
     * @param  \\Illuminate\\Http\\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title'            => $this->title,
            'description'      => $this->description,
            'format'           => $this->format,
            'eventTypeId'      => $this->eventTypeId,
            'eventCategoryId'  => $this->eventCategoryId,
            'startTime'        => $this->start_time,
            'endTime'          => $this->end_time,
            'isOpen'           => $this->is_open,
            'published'        => $this->published,
            'location'         => $this->location,
            'thumbnail'        => $this->thumbnail,
            'generalInfo'      => $this->general_info,            
            'eventType'        => new EventTypeResource($this->eventType ?? null),
            'eventCategory'    => new EventCategoryResource($this->eventCategory ?? null),
            'cameras' => !empty($this->cameras) ? array_map(function ($camera) {
                return [
                    'id' => $camera->id,
                    'event_id' => $camera->eventId,
                    'label' => $camera->label,
                    'angle' => $camera->angle,
                    'is_live' => $camera->isLive,
                ];
            }, $this->cameras) : [],
            'participants' => !empty($this->participants) 
                ? ParticipantResource::collection($this->participants)
                : [],

        ];
    }
}
