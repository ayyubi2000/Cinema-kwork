<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLatestNewRequest extends FormRequest
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
            'data.title' => 'required|array',
            'data.date' => 'required',
            'data.photo_url' => 'required',
            'data.content' => 'required|array',
            'data.status' => 'nullable',
            'data.studios' => 'nullable|array',
            'data.actors' => 'nullable|array',
            'data.tags' => 'nullable|array',
            'data.movies' => 'nullable|array',
        ];
    }
}