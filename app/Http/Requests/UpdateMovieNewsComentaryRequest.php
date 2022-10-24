<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieNewsComentaryRequest extends FormRequest
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
            'data.content' => 'required',
            'data.user_id' => 'required|numeric',
            'data.movie_news_id' => 'required|numeric',
            'data.parent_id' => 'nullable|numeric',
        ];
    }
}