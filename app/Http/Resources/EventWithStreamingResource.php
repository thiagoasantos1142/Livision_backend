<?php 

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventWithStreamingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'event' => new EventResource($this->event),
            'streaming_urls' => $this->streamingUrls,
        ];
    }
}
