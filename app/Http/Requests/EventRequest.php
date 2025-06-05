<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'format' => 'required|in:live,recorded',
            'event_type_id' => 'required|exists:event_types,id',
            'event_category_id' => 'required|exists:event_categories,id',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'is_open' => 'boolean',
            'published' => 'boolean',
            'thumbnail' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'general_info' => 'nullable|string',
            'participants' => 'nullable|array',
            'participants.*.name' => 'required|string|max:255',
            'participants.*.role' => 'required|string|max:255',
            
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório.',
            'event_type_id.required' => 'O tipo de evento é obrigatório.',
            'event_category_id.required' => 'A categoria do evento é obrigatória.',
            'start_time.date' => 'A data de início deve ser uma data válida.',
            'end_time.date' => 'A data de término deve ser uma data válida.',
            'end_time.after_or_equal' => 'A data de término deve ser igual ou posterior à data de início.'  
,
        ];
    }
}
