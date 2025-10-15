<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $eventParam = $this->route('event');
        $eventId = is_object($eventParam) ? ($eventParam->id ?? null) : $eventParam;
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:events,slug,' . ($eventId ?? 'NULL') . ',id',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'media_url' => 'nullable|string|max:2048',
            'status' => 'nullable|integer|in:0,1,2',
            'category_id' => 'nullable|integer|exists:categories,id',
        ];
    }
}
