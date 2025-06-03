<?php

namespace App\Http\Controllers\Api;

use App\Application\DTOs\Events\EventDTO;
use App\Application\UseCases\Events\CreateEventUseCase;
use App\Application\UseCases\Events\DeleteEventUseCase;
use App\Application\UseCases\Events\FindEventByIdUseCase;
use App\Application\UseCases\Events\GetAllEventsUseCase;
use App\Application\UseCases\Events\UpdateEventUseCase;
use App\Domain\Entities\EventEntity;

use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use Illuminate\Routing\Controller;

class EventController extends Controller
{
    public function __construct(
        private GetAllEventsUseCase $getAllEvents,
        private FindEventByIdUseCase $findEventById,
        private CreateEventUseCase $createEvent,
        private UpdateEventUseCase $updateEvent,
        private DeleteEventUseCase $deleteEvent,
    ) {}

    public function index()
    {
        $events = $this->getAllEvents->execute();
        return EventResource::collection($events);
    }

    public function show(int $id)
    {
        $event = $this->findEventById->execute($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        return new EventResource($event);
    }

    public function store(EventRequest $request)
    {
        $dto = new EventDTO(
            id: null, // ou algum valor se tiver
            title: $request->title,
            description: $request->description,
            startTime: $request->start_time,   // camelCase aqui
            endTime: $request->end_time,
            type: $request->type,
            categoryId: $request->category_id,
            isOpen: $request->is_open,
            published: $request->published
        );


       $entity = new EventEntity(
        id: $dto->id,
        title: $dto->title,
        description: $dto->description,
        type: $dto->type,
        categoryId: $dto->categoryId,
        start_time: $dto->startTime,  
        end_time: $dto->endTime,
        is_open: $dto->isOpen,
        published: $dto->published
    );

        $event = $this->createEvent->execute($entity);

        return new EventResource($event);
    }

    public function update(EventRequest $request, int $id)
    {
        $dto = new EventDTO(
            id: null,
            title: $request->title,
            description: $request->description,
            type: $request->type,
            category: $request->category,
            startTime: $request->start_time,
            endTime: $request->end_time,
            isOpen: $request->is_open,
            published: $request->published
        );

        $event = $this->updateEvent->execute($id, $dto);
        return new EventResource($event);
    }

    public function destroy(int $id)
    {
        $this->deleteEvent->execute($id);
        return response()->json([], 204);
    }
}
    