<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'publish_date' => 'required|date',
            'author_id' => 'required|exists:authors,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'publish_date.required' => 'The publish date field is required.',
            'author_id.required' => 'The author id field is required.',
            'author_id.exists' => 'The selected author id is invalid.'
        ];
    }
}
