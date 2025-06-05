<?php

namespace App\Application\DTOs\Events;

class EventDTO
{
    public ?int $id;
    public string $title;
    public ?string $description;
    public ?string $startTime;
    public ?string $endTime;
    public string $format;  // live ou recorded
    public int $eventTypeId;
    public int $eventCategoryId;
    public ?bool $isOpen;
    public ?bool $published;
    public ?string $thumbnail;
    public ?string $location;
    public ?string $generalInfo;
    public ?array $participants;

    public function __construct(
        ?int $id = null,
        string $title,
        ?string $description = null,
        ?string $startTime = null,
        ?string $endTime = null,
        string $format,
        int $eventTypeId,
        int $eventCategoryId,
        ?bool $isOpen = null,
        ?bool $published = null,
        ?string $thumbnail = null,
        ?string $location = null,
        ?string $generalInfo = null,
        ?array $participants = []
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->format = $format;
        $this->eventTypeId = $eventTypeId;
        $this->eventCategoryId = $eventCategoryId;
        $this->isOpen = $isOpen;
        $this->published = $published;
        $this->thumbnail = $thumbnail;
        $this->location = $location;
        $this->generalInfo = $generalInfo;
        $this->participants = $participants;
    }
}
