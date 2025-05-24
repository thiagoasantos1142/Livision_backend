<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\VideoEntity;
use App\Domain\Repositories\VideoRepositoryInterface;
use App\Models\Video;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class EloquentVideoRepository implements VideoRepositoryInterface
{
    public function create(array $data): VideoEntity
    {
        return DB::transaction(function () use ($data) {
            $video = Video::create([
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'type' => $data['type'],
                'rating' => $data['rating'],
                'year_launched' => $data['year_launched'] ?? null,
                'duration' => $data['duration'] ?? null,
                'is_open' => $data['is_open'] ?? false,
                'published' => $data['published'] ?? false,
                'season_id' => $data['season_id'] ?? null,
                'episode_number' => $data['episode_number'] ?? null
            ]);

             // Associa as categorias (se existirem)
            if (isset($data['categories'])) {
                $video->categories()->sync($data['categories']);
            }
            
            return new VideoEntity(
                id: $video->id,
                title: $video->title,
                description: $video->description,
                type: $video->type,
                rating: $video->rating,
                yearLaunched: $video->year_launched,
                duration: $video->duration,
                isOpen: $video->is_open,
                published: $video->published,
                seasonId: $video->season_id,
                episodeNumber: $video->episode_number,
                createdAt: $video->created_at,
                updatedAt: $video->updated_at
            );
        });
    }

    public function find(int $id): ?VideoEntity
    {
        $video = Video::find($id);
        
        if (!$video) {
            return null;
        }

        return new VideoEntity(
            id: $video->id,
            title: $video->title,
            description: $video->description,
            type: $video->type,
            rating: $video->rating,
            yearLaunched: $video->year_launched,
            duration: $video->duration,
            isOpen: $video->is_open,
            published: $video->published,
            categoryId: $video->category_id,
            seasonId: $video->season_id,
            episodeNumber: $video->episode_number,
            createdAt: $video->created_at,
            updatedAt: $video->updated_at
        );
    }

    public function update(int $id, array $data): VideoEntity
    {
        return DB::transaction(function () use ($id, $data) {
            $video = Video::findOrFail($id);
            
            $video->update([
                'title' => $data['title'] ?? $video->title,
                'description' => $data['description'] ?? $video->description,
                'type' => $data['type'] ?? $video->type,
                'rating' => $data['rating'] ?? $video->rating,
                'year_launched' => $data['year_launched'] ?? $video->year_launched,
                'duration' => $data['duration'] ?? $video->duration,
                'is_open' => $data['is_open'] ?? $video->is_open,
                'published' => $data['published'] ?? $video->published,
                'category_id' => $data['category_id'] ?? $video->category_id,
                'season_id' => $data['season_id'] ?? $video->season_id,
                'episode_number' => $data['episode_number'] ?? $video->episode_number
            ]);

            return new VideoEntity(
                id: $video->id,
                title: $video->title,
                description: $video->description,
                type: $video->type,
                rating: $video->rating,
                yearLaunched: $video->year_launched,
                duration: $video->duration,
                isOpen: $video->is_open,
                published: $video->published,
                categoryId: $video->category_id,
                seasonId: $video->season_id,
                episodeNumber: $video->episode_number,
                createdAt: $video->created_at,
                updatedAt: $video->updated_at
            );
        });
    }

    public function delete(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            return Video::destroy($id) > 0;
        });
    }

    public function all(): array
    {
        return Video::all()->map(function ($video) {
            return new VideoEntity(
                id: $video->id,
                title: $video->title,
                description: $video->description,
                type: $video->type,
                rating: $video->rating,
                yearLaunched: $video->year_launched,
                duration: $video->duration,
                isOpen: $video->is_open,
                published: $video->published,
                categoryId: $video->category_id,
                seasonId: $video->season_id,
                episodeNumber: $video->episode_number,
                createdAt: $video->created_at,
                updatedAt: $video->updated_at
            );
        })->toArray();
    }

   // app/Infrastructure/Repositories/EloquentVideoRepository.php
    private function mapToEntity(Video $video): VideoEntity
    {
        return new VideoEntity(
            id: $video->id,
            title: $video->title,
            description: $video->description,
            type: $video->type,
            rating: $video->rating,
            yearLaunched: $video->year_launched,
            duration: $video->duration,
            isOpen: $video->is_open,
            published: $video->published,
            seasonId: $video->season_id,
            episodeNumber: $video->episode_number,
            DateTimeInterface: $createdAt,
            DateTimeInterface: $updatedAt
        );
    }

    public function findByTitle(string $title): ?VideoEntity
    {
        $video = Video::where('title', $title)->first();

        if (!$video) {
            return null;
        }

        return $this->mapToEntity($video);
    }
}