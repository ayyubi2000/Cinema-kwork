<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'data.photo_url' => 'required',
            'data.title' => 'required',
            'data.content' => 'required',
            'data.movie_id' => 'required',
            'data.tags' => 'nullable',
        ];
    }
}