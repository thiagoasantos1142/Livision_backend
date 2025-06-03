<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateUploadUrlRequest extends FormRequest
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
        ];
    }
}
