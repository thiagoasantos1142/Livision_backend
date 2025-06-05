<?php

namespace App\Http\Controllers\Api;

use App\Application\DTOs\Events\EventDTO;
use App\Application\UseCases\Events\CreateEventUseCase;
use App\Application\UseCases\Events\DeleteEventUseCase;
use App\Application\UseCases\Events\FindEventByIdUseCase;
use App\Application\UseCases\Events\GetAllEventsUseCase;
use App\Application\UseCases\Events\UpdateEventUseCase;
use App\Domain\Entities\EventEntity;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

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

    public function show(int $id): JsonResponse
    {
        $event = $this->findById->execute($id);

        if (!$event) {
            return response()->json(['message' => 'Evento não encontrado'], 404);
        }

        return response()->json(new EventResource($event));
    }

     public function store(EventRequest $request)
    {
        $dto = new EventDTO(
            id: null,
            title: $request->title,
            description: $request->description,
            startTime: $request->start_time,
            endTime: $request->end_time,
            format: $request->format,
            eventTypeId: $request->event_type_id,
            eventCategoryId: $request->event_category_id,
            isOpen: $request->is_open,
            published: $request->published,
            location: $request->location,
            thumbnail: $request->thumbnail,
            generalInfo: $request->general_info,
            participants: $request->participants
        );

        // Upload da thumbnail direto aqui, opcional
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 's3');
            // Gera url assinada ou url pública (depende da config do bucket)
            $url = Storage::disk('s3')->url($path);

            $dto['thumbnail'] = $url;
        }

        $entity = new EventEntity(
            id: $dto->id,
            title: $dto->title,
            slug: Str::slug($dto->title), // Assuming you have a helper function for slug generation
            description: $dto->description,
            format: $dto->format,
            eventTypeId: $dto->eventTypeId,
            eventCategoryId: $dto->eventCategoryId,
            start_time: $dto->startTime,
            end_time: $dto->endTime,
            is_open: $dto->isOpen,
            published: $dto->published,
            location: $dto->location,
            thumbnail: $dto->thumbnail,
            general_info: $dto->generalInfo,
            participants: $dto->participants
        );
        $event = $this->createEvent->execute($entity);

        return new EventResource($event);
    }

      public function update(EventRequest $request, int $id): JsonResponse
    {
        $dto = new \App\Application\DTOs\Events\EventDTO(
            id: $id,
            title: $request->title,
            description: $request->description,
            format: $request->format,
            eventTypeId: $request->event_type_id,
            eventCategoryId: $request->event_category_id,
            startTime: $request->start_time,
            endTime: $request->end_time,
            isOpen: $request->is_open,
            published: $request->published,
            location: $request->location,
            thumbnail: $request->thumbnail,
            generalInfo: $request->general_info,
            participants: $request->participants ?? [],
        );

        $entity = new EventEntity(
            id: $dto->id,
            title: $dto->title,
            slug: Str::slug($dto->title), // Assuming you have a helper function for slug generation
            description: $dto->description,
            format: $dto->format,
            eventTypeId: $dto->eventTypeId,
            eventCategoryId: $dto->eventCategoryId,
            start_time: $dto->startTime,
            end_time: $dto->endTime,
            is_open: $dto->isOpen,
            published: $dto->published,
            location: $dto->location,
            thumbnail: $dto->thumbnail,
            general_info: $dto->generalInfo,
            participants: $dto->participants
        );

        $event = $this->updateEvent->execute($id, $entity);

        return response()->json(new EventResource($event));
    }

    public function destroy(int $id)
    {
        $this->deleteEvent->execute($id);
        return response()->json([], 204);
    }
}
    