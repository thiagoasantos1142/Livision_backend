<?php 

namespace App\Application\DTOs\Events;

use App\Domain\Entities\EventEntity;

class EventWithStreamingDTO
{
    public function __construct(
        public EventEntity $event,
        public array $streamingUrls
    ) {}
}
