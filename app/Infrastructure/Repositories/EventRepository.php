<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\CameraEntity;
use App\Domain\Entities\CameraVideoEntity;
use App\Domain\Entities\EventEntity;
use Illuminate\Support\Str;
use App\Models\EventParticipant;
use App\Models\Participant;
use App\Domain\Repositories\EventRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Event;

class EventRepository implements EventRepositoryInterface
{
    public function create(EventEntity $event): EventEntity
    {
        
        $model = Event::create([
            'title' => $event->title,
            'slug' => Str::slug($event->title),
            'description' => $event->description,
            'format' => $event->format,
            'event_type_id' => $event->eventTypeId,
            'event_category_id' => $event->eventCategoryId,
            'start_time' => $event->start_time,
            'end_time' => $event->end_time,
            'is_open' => $event->is_open,
            'published' => $event->published,
            'location' => $event->location,
            'thumbnail' => $event->thumbnail,
            'general_info' => $event->general_info,
        ]);

        if (!empty($event->participants)) {
            foreach ($event->participants as $participant) {
                // Primeiro, cria ou busca o participante pelo nome (ou outra regra)
                $participantModel = Participant::firstOrCreate(
                    ['name' => $participant['name']],
                    ['type' => $participant['type'] ?? null]
                );

                // Agora cria a relação na tabela pivô com a role
                EventParticipant::create([
                    'event_id' => $model->id,
                    'participant_id' => $participantModel->id,
                    'role' => $participant['role'],
                ]);
            }
        }

        return EventEntity::fromModel($model);
    }

    public function find(int $id): ?EventEntity
    {
        $model = Event::with(['cameras.videos', 'participants'])->find($id);

        if (!$model) {
            return null;
        }

        return EventEntity::fromModel($model);
    }

    public function all(): array
    {
        return Event::with(['cameras', 'participants'])
            ->get()
            ->map(fn ($model) => EventEntity::fromModel($model))
            ->toArray();
    }

     public function update(int $id, EventEntity $event): EventEntity
    {
        $model = Event::findOrFail($id);

        $model->update([
            'title' => $event->title,
            'description' => $event->description,
            'format' => $event->format,
            'event_type_id' => $event->eventTypeId,
            'event_category_id' => $event->eventCategoryId,
            'start_time' => $event->start_time,
            'end_time' => $event->end_time,
            'is_open' => $event->is_open,
            'published' => $event->published,
            'location' => $event->location,
            'thumbnail' => $event->thumbnail,
            'general_info' => $event->general_info,
        ]);

        $this->syncParticipants($model, $event->participants);

        return EventEntity::fromModel($model->load('participants'));
    }

     public function findById(int $id): ?EventEntity
    {
        $model = Event::with('participants')->find($id);

        return $model ? EventEntity::fromModel($model) : null;
    }

    public function findAll(): array
    {
        return Event::with('participants')
            ->get()
            ->map(fn ($model) => EventEntity::fromModel($model)->toArray())
            ->toArray();
    }

    private function syncParticipants(Event $event, ?array $participants): void
    {
        if (!is_array($participants)) return;

        // Remove antigos
        $event->participants()->delete();

        // Insere novos
        foreach ($participants as $participant) {
            $event->participants()->create([
                'name' => $participant['name'],
                'role' => $participant['role'],
            ]);
        }
    }

    public function delete(int $id): bool
    {
        $model = Event::find($id);
        return $model ? $model->delete() : false;
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Event::with('cameras')->paginate($perPage);
    }

    public function addParticipant(int $eventId, int $participantId, string $role): void
    {
        EventParticipant::create([
            'event_id' => $eventId,
            'participant_id' => $participantId,
            'role' => $role,
        ]);
    }

    public function findByIdWithCamerasAndVideos(int $id): ?EventEntity
    {
        $event = Event::with(['cameras.videos'])->findOrFail($id);

        // Mapeamento manual para EventEntity
        return new EventEntity(
            id: $event->id,
            title: $event->title,
            slug: $event->slug,
            description: $event->description,
            format: $event->format,
            eventTypeId: $event->event_type_id,
            eventCategoryId: $event->event_category_id,
            start_time: $event->start_time,
            end_time: $event->end_time,
            is_open: $event->is_open,
            published: $event->published,
            thumbnail: $event->thumbnail,
            location: $event->location,
            general_info: $event->general_info,
            participants: [], // ou carregue os participantes também se necessário
            cameras: $event->cameras->map(function ($camera) {
                    return new CameraEntity(
                        id: $camera->id,
                        eventId: $camera->event_id,
                        label: $camera->label,
                        angle: $camera->angle,
                        videos: $camera->videos->map(fn ($video) => CameraVideoEntity::fromModel($video))->toArray(),
                        isLive: $camera->is_live
                    );
                })->toArray()
        );
}

}
