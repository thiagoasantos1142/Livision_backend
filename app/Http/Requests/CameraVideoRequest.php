<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CameraVideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'camera_id' => 'required|exists:cameras,id',
            'filename' => 'required|string|max:255',
            'path' => 'required|string|max:1000',
            'duration' => 'nullable|integer|min:1',
            'recorded_at' => 'nullable|date',
        ];
    }
}
