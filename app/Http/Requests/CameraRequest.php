<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CameraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'event_id' => 'required|exists:events,id',
            'label' => 'required|string|max:255',
            'angle' => 'nullable|string|max:255',
            'is_live' => 'boolean',
        ];
    }
}
