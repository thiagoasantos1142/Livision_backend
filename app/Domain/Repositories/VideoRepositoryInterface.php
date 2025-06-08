<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\EventEntity;

interface VideoRepositoryInterface
{
    public function findById(int $id): ?EventEntity;

    public function getAll(): array;


    public function create(EventEntity $event): EventEntity;

    public function update(int $id, EventEntity $event): EventEntity;

    public function delete(int $id): bool;
}
