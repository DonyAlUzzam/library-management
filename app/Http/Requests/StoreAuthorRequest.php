<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {

        return [
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'birth_date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'birth_date.required' => 'The birth date field is required.',
        ];
    }
}
