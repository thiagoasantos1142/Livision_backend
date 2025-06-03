<?php

namespace App\Http\Controllers\Api;

use App\Application\DTOs\Genres\AttachGenresToEventDTO;
use App\Application\UseCases\Genres\CreateGenreUseCase;
use App\Application\UseCases\Genres\DeleteGenreUseCase;
use App\Application\UseCases\Genres\FindGenreByIdUseCase;
use App\Application\UseCases\Genres\GetAllGenresUseCase;
use App\Application\UseCases\Genres\UpdateGenreUseCase;
use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;
use App\Domain\Entities\GenreEntity;
use Illuminate\Routing\Controller;

class GenreController extends Controller
{
    public function __construct(
        private GetAllGenresUseCase $getAllGenres,
        private FindGenreByIdUseCase $findGenreById,
        private CreateGenreUseCase $createGenre,
        private UpdateGenreUseCase $updateGenre,
        private DeleteGenreUseCase $deleteGenre,
    ) {}

    public function index()
    {
        $genres = $this->getAllGenres->execute();
        return GenreResource::collection($genres);
    }

    public function show(int $id)
    {
        $genre = $this->findGenreById->execute($id);
        if (!$genre) {
            return response()->json(['message' => 'Genre not found'], 404);
        }
        return new GenreResource($genre);
    }

    public function store(GenreRequest $request)
    {
        $genre = new GenreEntity(null, $request->name);
        $created = $this->createGenre->execute($genre);
        return new GenreResource($created);
    }

    public function update(GenreRequest $request, int $id)
    {
        $genre = new GenreEntity($id, $request->name);
        $updated = $this->updateGenre->execute($id, $genre);
        return new GenreResource($updated);
    }

    public function destroy(int $id)
    {
        $this->deleteGenre->execute($id);
        return response()->json([], 204);
    }
}
