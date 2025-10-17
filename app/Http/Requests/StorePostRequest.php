<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,NULL,id',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'status' => 'nullable|integer|in:0,1,2',
            'published_at' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
            'reading_time' => 'nullable|integer|min:0',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'integer|exists:categories,id',
            'media' => 'nullable|array',
            'media.*.type' => 'required|integer|in:0,1,2',
            'media.*.url' => 'required|string|max:2048',
            'media.*.alt' => 'nullable|string|max:255',
            'media.*.caption' => 'nullable|string|max:255',
            'media.*.is_primary' => 'nullable|in:0,1,true,false,on,off',
            'media.*.sort_order' => 'nullable|integer|min:0',
        ];
    }
}
