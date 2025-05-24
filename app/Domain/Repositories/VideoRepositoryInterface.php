<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\VideoEntity;

interface VideoRepositoryInterface
{
    public function all(): array;
    public function find(int $id): ?VideoEntity;
    public function create(array $data): VideoEntity;
    public function update(int $id, array $data): VideoEntity;
    public function delete(int $id): bool;
}
