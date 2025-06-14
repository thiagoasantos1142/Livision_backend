<?php

namespace App\Domain\Repositories;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Domain\Entities\EventEntity;

interface EventRepositoryInterface
{
    public function create(EventEntity $event): EventEntity;

    public function find(int $id): ?EventEntity;

    public function all(): array;

    public function update(int $id, EventEntity $event): EventEntity;

    public function findById(int $id): ?EventEntity;

    public function delete(int $id): bool;
    
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function addParticipant(int $eventId, int $participantId, string $role): void;

    public function findByIdWithCamerasAndVideos(int $id): ?EventEntity;


}
