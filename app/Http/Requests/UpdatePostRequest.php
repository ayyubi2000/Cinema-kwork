<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data.photo_url' => 'nullable',
            'data.title' => 'nullable',
            'data.content' => 'nullable',
            'data.user_id' => 'nullable',
            'data.movie_id' => 'nullable',
            'data.tags' => 'nullable|array',
            'data.status' => 'nullable',
            'data.validation_message' => 'nullable',
        ];
    }
}