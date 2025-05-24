<?php

namespace App\Application\UseCases\Video;

use Illuminate\Http\UploadedFile;
use App\Domain\Repositories\VideoRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class UploadVideoUseCase
{
    public function __construct(private VideoRepositoryInterface $repository) {}

    public function execute(int $id, UploadedFile $file): string
    {
        $video = $this->repository->find($id);

        $path = "videos/{$id}/" . uniqid() . '.' . $file->getClientOriginalExtension();
        $url = Storage::disk('s3')->put($path, $file, 'public');

        $this->repository->update($id, ['video_path' => $path]);

        return Storage::disk('cloudfront')->url($path); // via custom driver or signed URL
    }
}
