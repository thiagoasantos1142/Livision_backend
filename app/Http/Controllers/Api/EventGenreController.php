<?php

namespace App\Http\Controllers\Api;

use App\Application\DTOs\Genres\AttachGenresToEventDTO;
use App\Application\UseCases\EventGenres\AttachGenresToEventUseCase;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EventGenreController extends Controller
{
    public function __construct(
        private AttachGenresToEventUseCase $attachGenresToEvent
    ) {}

    public function attach(Request $request, int $eventId)
    {
        $validated = $request->validate([
            'genre_ids' => 'required|array',
            'genre_ids.*' => 'integer|exists:genres,id',
        ]);

        $dto = new AttachGenresToEventDTO(
            eventId: $eventId,
            genreIds: $validated['genre_ids']
        );

        $this->attachGenresToEvent->execute($dto);

        return response()->json(['message' => 'Genres attached successfully']);
    }
}
