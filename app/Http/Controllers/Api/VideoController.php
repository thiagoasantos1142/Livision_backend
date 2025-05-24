<?php


namespace App\Http\Controllers\Api;

use App\Application\UseCases\Video\GenerateSignedUrlUseCase;
use App\Application\UseCases\Video\UploadVideoUseCase;
use App\Application\UseCases\Video\GetSignedVideoUrlUseCase;
use App\Domain\Repositories\VideoRepositoryInterface;
use App\Application\UseCases\Video\ListVideosUseCase;
use App\Application\UseCases\Video\GetVideoUseCase;
use App\Application\UseCases\Video\CreateVideoUseCase;
use App\Application\UseCases\Video\UpdateVideoUseCase;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __construct(
        private VideoRepositoryInterface $repository,
        protected UploadVideoUseCase $uploadVideoUseCase
    ) {}

    public function index(ListVideosUseCase $useCase)
    {
        return response()->json($useCase->execute());
    }

    public function show(int $id, GetVideoUseCase $useCase)
    {
        return response()->json($useCase->execute($id));
    }

    public function upload(int $id, Request $request, UploadVideoUseCase $useCase)
    {
        $request->validate([
            'video_file' => 'required|file|mimetypes:video/mp4,video/x-matroska|max:512000', // 500MB
        ]);

        $path = $useCase->execute($id, $request->file('video_file'));

        return response()->json(['url' => $path], 200);
    }

    public function getUrl(Request $request, GenerateSignedUrlUseCase $useCase)
    {
        $request->validate(['path' => 'required|string']);

        $url = $useCase->handle($request->path);
        return response()->json(['url' => $url]);
    }

    public function store(StoreVideoRequest $request, CreateVideoUseCase $useCase)
    {
        $video = $useCase->execute($request->validated());

        $file = $request->file('video_file');

        $result = $useCase->execute($video, $file);

        return response()->json($result, 201); 
    }

     public function update(int $id, Request $request, UpdateVideoUseCase $useCase)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'type' => 'sometimes|required|in:movie,series,episode,live_event,recorded_event',
            'rating' => 'sometimes|required|in:L,10,12,14,16,18',
            'year_launched' => 'nullable|integer',
            'duration' => 'nullable|integer',
            'is_open' => 'boolean',
            'published' => 'boolean',
        ]);

        return response()->json($useCase->execute($id, $data));
    }

    public function destroy(int $id, DeleteVideoUseCase $useCase)
    {
        $useCase->execute($id);
        return response()->json(['message' => 'Video deleted successfully']);
    }
}
