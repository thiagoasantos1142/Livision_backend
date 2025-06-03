<?php

namespace App\Application\DTOs\Events;

class EventDTO
{
    public ?int $id;
    public string $title;
    public ?string $description;
    public ?string $startTime;
    public ?string $endTime;
    public ?string $type;  
    public ?int $categoryId;
    public ?bool $isOpen; 
    public ?bool $published; 


    public function __construct(
        ?int $id = null,
        string $title,
        ?string $description = null,
         ?string $startTime = null,
        ?string $endTime = null,
        ?string $type = null, 
        ?int $categoryId = null,
        ?bool $isOpen = null,
        ?bool $published = null 
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
       $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->type = $type;
        $this->categoryId = $categoryId;
        $this->isOpen = $isOpen;
        $this->published = $published;
    }
}
