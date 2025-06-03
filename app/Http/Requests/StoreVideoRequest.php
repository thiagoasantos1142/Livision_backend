<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:movie,series,episode,live_event,recorded_event',
            'rating' => 'required|in:L,10,12,14,16,18',
            'year_launched' => 'nullable|integer|min:1900|max:' . (date('Y') + 5),
            'duration' => 'nullable|integer|min:1',
            'is_open' => 'boolean',
            'published' => 'boolean',
            'category_id' => 'required|exists:categories,id',
            'season_id' => 'nullable|exists:seasons,id',
            'episode_number' => 'nullable|integer|min:1',
            'video_file' => 'required|file|mimetypes:video/mp4,video/x-matroska|max:512000',
        ];
    }
}
