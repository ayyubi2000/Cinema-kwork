<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieNewRequest extends FormRequest
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
            'data.photo_url' => 'required',
            'data.title' => 'required|array',
            'data.title.ru' => 'required',
            'data.content' => 'required|array',
            'data.content.ru' => 'required',
            'data.movie_id' => 'required|numeric',
        ];
    }
}